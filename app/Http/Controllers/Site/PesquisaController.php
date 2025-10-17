<?php
// app/Http/Controllers/Site/PesquisaController.php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Secretary;
use App\Models\Page;
use App\Models\Legislation;
use App\Models\Councilor;
use App\Models\DirectorTable;
use App\Models\Menu;
use App\Models\ProcessoCompras;
use App\Models\Proposition;
use App\Models\Session;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

class PesquisaController extends Controller
{
    private $tenant, $menu;

    public function __construct(Tenant $tenant, Menu $menu)
    {
        $this->tenant = $tenant;
        $this->menu = $menu;
    }
    public function pesquisar(Request $request)
    {

        
        $termo = $request->input('pesquisar');
        $template = view()->shared('currentTemplate');
        $tenant = $this->tenant->first();
        $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
            ->orderBy('ordem')
            ->get();
        $selosTransparencia = $tenant->anexos()
            ->where('tipo_anexo', 1)
            ->where('situacao', 1)
            ->get();
       
        
        if (empty($termo) || strlen($termo) < 3) {
            return redirect()->back()->with('error', 'Digite pelo menos 3 caracteres para pesquisar.');
        }

        $resultados = $this->buscarEmTodasEntidades($termo);
        
        return view("public_templates.$template.includes.pesquisar.resultado", [
            'termo' => $termo,
            'resultados' => $resultados,
            'menus' => $menus,
            'selosTransparencia' => $selosTransparencia,
            'tenant' => $tenant,
            'total' => $this->contarResultados($resultados)
        ]);
    }

    private function buscarEmTodasEntidades($termo)
    {
        return [
            'noticias' => $this->buscarNoticias($termo),
            'secretarias' => $this->buscarSecretarias($termo),
            'paginas' => $this->buscarPaginas($termo),
            'leis' => $this->buscarLeis($termo),
            'vereadores' => $this->buscarVereadores($termo),
            'licitacoes' => $this->buscarLicitacoes($termo),
            'sessoes' => $this->buscarSessoes($termo),
            'proposicoes' => $this->buscarProposicoes($termo),
            'comissoes' => $this->buscarComissoes($termo),
            'mesas_diretoras' => $this->buscarMesasDiretoras($termo)
        ];
    }

    private function buscarNoticias($termo)
    {
        return Post::where(function($query) use ($termo) {
            $query->where('titulo', 'LIKE', "%{$termo}%")
                  ->orWhere('conteudo', 'LIKE', "%{$termo}%");
        })
        ->where(function ($query) {
            $query->where('data_expiracao', '>=', now())
                  ->orWhereNull('data_expiracao');
        })
        ->with('secretary')
        ->orderBy('created_at', 'desc')
        ->limit(10)
        ->get()
        ->map(function($post) {
            return [
                'tipo' => 'Notícia',
                'titulo' => $post->titulo,
                'resumo' => $this->extrairResumo($post->conteudo),
                'url' => route('noticias.show', $post->url),
                'data' => $post->created_at->format('d/m/Y'),
                'categoria' => $post->secretary->nome ?? 'Geral'
            ];
        });
    }

    private function buscarSecretarias($termo)
    {
        return Secretary::where(function($query) use ($termo) {
            $query->where('nome', 'LIKE', "%{$termo}%")
                  ->orWhere('sobre_secretario', 'LIKE', "%{$termo}%")
                  ->orWhere('sigla', 'LIKE', "%{$termo}%")
                  ->orWhere('sobre', 'LIKE', "%{$termo}%")
                  ->orWhere('slogan', 'LIKE', "%{$termo}%");
        })
        ->limit(5)
        ->get()
        ->map(function($secretaria) {
            return [
                'tipo' => 'Secretaria',
                'titulo' => $secretaria->nome,
                'resumo' => $this->extrairResumo($secretaria->sobre),
                'url' => route('site.secretarias.show', $secretaria->sigla),
                'data' => null,
                'categoria' => 'Estrutura Administrativa'
            ];
        });
    }

    private function buscarPaginas($termo)
    {
        return Page::where(function($query) use ($termo) {
            $query->where('titulo', 'LIKE', "%{$termo}%")
                  ->orWhere('conteudo', 'LIKE', "%{$termo}%");
        })
        ->limit(5)
        ->get()
        ->map(function($pagina) {
            return [
                'tipo' => 'Página',
                'titulo' => $pagina->titulo,
                'resumo' => $this->extrairResumo($pagina->conteudo),
                'url' => route('pagina', $pagina->slug),
                'data' => $pagina->updated_at->format('d/m/Y'),
                'categoria' => 'Institucional'
            ];
        });
    }

    private function buscarLeis($termo)
    {
        return Legislation::where(function($query) use ($termo) {
            $query->where('caput', 'LIKE', "%{$termo}%")
                  ->orWhere('descricao', 'LIKE', "%{$termo}%")
                  ->orWhere('numero', 'LIKE', "%{$termo}%");
        })
        ->limit(10)
        ->get()
        ->map(function($lei) {
            return [
                'tipo' => 'Legislação',
                'titulo' => $lei->numero,
                'resumo' => $this->extrairResumo($lei->caput),
                'url' => route('site.legislacao.show', $lei->id), // Ajuste conforme sua rota
                'data' => $lei->data ? $lei->data->format('d/m/Y') : null,
                'categoria' => 'Legislação'
            ];
        });
    }

    private function buscarVereadores($termo)
    {
        return Councilor::where(function($query) use ($termo) {
            $query->where('nome', 'LIKE', "%{$termo}%")
                  ->orWhere('nome_parlamentar', 'LIKE', "%{$termo}%")
                  ->orWhere('biografia', 'LIKE', "%{$termo}%");
        })
        ->where('atual', 1)
        ->limit(5)
        ->get()
        ->map(function($vereador) {
            return [
                'tipo' => 'Vereador',
                'titulo' => $vereador->nome_parlamentar ?: $vereador->nome,
                'resumo' => $this->extrairResumo($vereador->biografia),
                'url' => route('site.vereadores.show', $vereador->id), // Ajuste conforme sua rota
                'data' => null,
                'categoria' => 'Poder Legislativo'
            ];
        });
    }

    private function buscarLicitacoes($termo)
    {
        return ProcessoCompras::where(function($query) use ($termo) {
            $query->where('objeto', 'LIKE', "%{$termo}%")
                  ->orWhere('numero', 'LIKE', "%{$termo}%")
                  ->orWhere('descricao', 'LIKE', "%{$termo}%");
        })
        ->limit(5)
        ->get()
        ->map(function($licitacao) {
            return [
                'tipo' => 'Licitação',
                'titulo' => "Processo nº {$licitacao->numero}",
                'resumo' => $this->extrairResumo($licitacao->objeto),
                'url' => route('site.compras.show', $licitacao->id),
                'data' => $licitacao->data_publicacao ? $licitacao->data_publicacao->format('d/m/Y') : null,
                'categoria' => 'Transparência'
            ];
        });
    }
    private function buscarSessoes($termo)
    {
        return Session::where(function($query) use ($termo) {
            $query->where('nome', 'LIKE', "%{$termo}%")
                ->orWhere('descricao', 'LIKE', "%{$termo}%");
        })
        ->orderBy('data', 'desc')
        ->limit(10)
        ->get()
        ->map(function($sessao) {
            return [
                'tipo' => 'Sessão',
                'titulo' => "Sessão {$sessao->nome}" . ($sessao->nome ? " - {$sessao->nome}" : ""),
                'resumo' => $this->extrairResumo($sessao->descricao ?? $sessao->descricao),
                'url' => route('site.sessoes.show', $sessao->id),
                'data' => $sessao->data ? $sessao->data->format('d/m/Y') : null,
                'categoria' => 'Atividade Legislativa'
            ];
        });
    }

 
    private function buscarProposicoes($termo)
    {
        return Proposition::where(function($query) use ($termo) {
            $query->where('numero', 'LIKE', "%{$termo}%")
                ->orWhere('descricao', 'LIKE', "%{$termo}%");
        })
        ->orderBy('data', 'desc')
        ->limit(10)
        ->get()
        ->map(function($proposicao) {
            return [
                'tipo' => 'Proposição',
                'titulo' => "{$proposicao->numero}",
                'resumo' => $this->extrairResumo($proposicao->descricao ?? $proposicao->descricao),
                'url' => route('site.proposicoes.show', $proposicao->id),
                'data' => $proposicao->data ? $proposicao->data->format('d/m/Y') : null,
                'categoria' => 'Proposição Legislativa'
            ];
        });
    }
    private function buscarComissoes($termo)
    {
        return Commission::where(function($query) use ($termo) {
            $query->where('nome', 'LIKE', "%{$termo}%")
                ->orWhere('objetivo', 'LIKE', "%{$termo}%");
        })
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get()
        ->map(function($comissao) {
            return [
                'tipo' => 'Comissão',
                'titulo' => $comissao->nome ? "{$comissao->nome} - {$comissao->nome}" : $comissao->nome,
                'resumo' => $this->extrairResumo($comissao->objetivo ?? $comissao->objetivo),
                'url' => route('site.comissoes.show', $comissao->id),
                'data' => null,
                'categoria' => 'Estrutura Legislativa'
            ];
        });
    }
    private function buscarMesasDiretoras($termo)
    {
        return DirectorTable::where(function($query) use ($termo) {
            $query->where('nome', 'LIKE', "%{$termo}%")
                ->orWhere('objetivo', 'LIKE', "%{$termo}%")                
                ->orWhereHas('membros', function($q) use ($termo) {
                    $q->where('nome', 'LIKE', "%{$termo}%");
                });
        })
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get()
        ->map(function($mesa) {
            return [
                'tipo' => 'Mesa Diretora',
                'titulo' => $mesa->nome ?? "Mesa Diretora {$mesa->periodo}",
                'resumo' => $this->extrairResumo($mesa->objetivo ?? "Mesa diretora do período {$mesa->periodo}"),
                'url' => route('site.mesas-diretoras.show', $mesa->id),
                'data' => null,
                'categoria' => 'Estrutura Legislativa'
            ];
        });
    }
   private function extrairResumo($texto, $limite = 150)
    {
        if (empty($texto)) return '';
        
        $texto = strip_tags($texto);
        return strlen($texto) > $limite ? substr($texto, 0, $limite) . '...' : $texto;
    }
    private function contarResultados($resultados)
    {
        return array_sum(array_map('count', $resultados));
    }

    // Método para pesquisa AJAX (opcional)
    public function pesquisarAjax(Request $request)
    {
        $termo = $request->input('q');
        
        if (strlen($termo) < 2) {
            return response()->json([]);
        }

        $resultados = $this->buscarEmTodasEntidades($termo);
        
        // Limitar resultados para autocomplete
        $sugestoes = [];
        foreach ($resultados as $categoria => $items) {
            foreach ($items->take(3) as $item) {
                $sugestoes[] = [
                    'titulo' => $item['titulo'],
                    'tipo' => $item['tipo'],
                    'url' => $item['url']
                ];
            }
        }

        return response()->json($sugestoes);
    }
}