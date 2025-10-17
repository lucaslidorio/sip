<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ProcessoCompras;
use App\Models\Modalidades;
use App\Models\CriterioJulgamento;
use App\Models\Link;
use App\Models\Menu;
use App\Models\ProceedingSituation;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LicitacoesController extends Controller
{
    /**
     * Exibe a listagem de licitações/processos de compras
     */

    private $tenant, $menu, $link;
    public function __construct( Tenant $tenant, Menu $menu, Link $link)
    {
        // Middleware para compartilhar o tenant atual
        $this->tenant = $tenant;     
        $this->menu = $menu;  
        $this->link = $link;
    }
    public function index(Request $request)
    {
        $tenant = $this->tenant->first();
        $template = view()->shared('currentTemplate');
        $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
            ->orderBy('ordem')
            ->get();
        $selosTransparencia = $tenant->anexos()
            ->where('tipo_anexo', 1)
            ->where('situacao', 1)
            ->get();
        $linksUteisInferior = $this->link::porTipo(2)->porPosicao(4)->get();
        // Query base
        $query = ProcessoCompras::with([
            'modalidade',
            'criterio_julgamento', 
            'situacao',
            'anexos',
            'credenciamentos.dadoPessoa'
        ]);

        // Filtros de busca
        if ($request->filled('busca')) {
            $busca = $request->busca;
            $query->where(function($q) use ($busca) {
                $q->where('objeto', 'LIKE', "%{$busca}%")
                  ->orWhere('descricao', 'LIKE', "%{$busca}%")
                  ->orWhere('numero', 'LIKE', "%{$busca}%");
            });
        }

        // Filtro por modalidade
        if ($request->filled('modalidade')) {
            $query->where('modalidade_id', $request->modalidade);
        }

        // Filtro por critério de julgamento
        if ($request->filled('criterio_julgamento')) {
            $query->where('criterio_julgamento_id', $request->criterio_julgamento);
        }

        // Filtro por situação
        if ($request->filled('situacao')) {
            $query->where('proceeding_situation_id', $request->situacao);
        }

        // Filtros de data
        if ($request->filled('data_inicio')) {
            $query->whereDate('data_publicacao', '>=', $request->data_inicio);
        }

        if ($request->filled('data_fim')) {
            $query->whereDate('data_publicacao', '<=', $request->data_fim);
        }

        // Filtros de valor
        if ($request->filled('valor_min')) {
            $query->where('valor_estimado', '>=', $request->valor_min);
        }

        if ($request->filled('valor_max')) {
            $query->where('valor_estimado', '<=', $request->valor_max);
        }

        // Ordenação
        $query->orderBy('data_publicacao', 'desc')
              ->orderBy('created_at', 'desc');

        // Paginação
        $processos = $query->paginate(10);

        // Dados para os filtros
        $modalidades = Modalidades::orderBy('nome')
                                 ->get();

        $criteriosJulgamento = CriterioJulgamento::orderBy('nome')
                                               ->get();

        $situacoes = ProceedingSituation::where('processo_compra', 1)->orderBy('nome')
                                       ->get();

        // Estatísticas
        $totalProcessos = ProcessoCompras::count();
        $processosAtivos = ProcessoCompras::where('proceeding_situation_id', 33)->count(); // Situação "recebendo proposta"
        $processosHomologados = ProcessoCompras::where('proceeding_situation_id', 35)->count(); // Situação "homologado"

        return view("public_templates.$template.includes.licitacoes.licitacoes_index", compact(
            'processos',
            'modalidades',
            'criteriosJulgamento',
            'situacoes',
            'totalProcessos',
            'processosAtivos',
            'processosHomologados',
            'tenant',
            'menus',            
            'selosTransparencia',
            'linksUteisInferior'
        ));
    }

    /**
     * Exibe os detalhes de uma licitação específica
     */
    public function show($id)
    {
        $tenant = $this->tenant->first();
        $template = view()->shared('currentTemplate');
        $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
            ->orderBy('ordem')
            ->get();
        $selosTransparencia = $tenant->anexos()
            ->where('tipo_anexo', 1)
            ->where('situacao', 1)
            ->get();
        $linksUteisInferior = $this->link::porTipo(2)->porPosicao(4)->get();
        $processo = ProcessoCompras::with([
        'modalidade', 
        'criterio_julgamento', 
        'situacao',
        'anexos'
    ])->findOrFail($id);
    // Obter credenciamentos válidos usando o novo método
    $empresasCredenciadas = $processo->getCredenciadosValidos();
    
        // Processos relacionados (mesma modalidade, excluindo o atual)
        $processosRelacionados = ProcessoCompras::with(['modalidade', 'situacao'])
            ->where('modalidade_id', $processo->modalidade_id)
            ->where('id', '!=', $processo->id)
            ->orderBy('data_publicacao', 'desc')
            ->limit(5)
            ->get();

        return view("public_templates.$template.includes.licitacoes.licitacoes_show", compact(
            'processo',
            'processosRelacionados',
            'tenant',
            'menus',
            'selosTransparencia',
            'linksUteisInferior',
            'empresasCredenciadas'
        ));
    }

    /**
     * API para busca de processos (AJAX)
     */
    public function search(Request $request)
    {
        $query = ProcessoCompras::with(['modalidade', 'situacao']);

        if ($request->filled('term')) {
            $term = $request->term;
            $query->where(function($q) use ($term) {
                $q->where('objeto', 'LIKE', "%{$term}%")
                  ->orWhere('numero', 'LIKE', "%{$term}%");
            });
        }

        $processos = $query->orderBy('data_publicacao', 'desc')
                          ->limit(10)
                          ->get()
                          ->map(function($processo) {
                              return [
                                  'id' => $processo->id,
                                  'numero' => $processo->numero,
                                  'objeto' => $processo->objeto,
                                  'modalidade' => $processo->modalidade->nome ?? 'N/A',
                                  'situacao' => $processo->situacao->nome ?? 'N/A',
                                  'url' => route('licitacoes.show', $processo->id)
                              ];
                          });

        return response()->json($processos);
    }

    /**
     * Exporta lista de processos para Excel/CSV
     */
    public function export(Request $request)
    {
        // Aplicar os mesmos filtros da listagem
        $query = ProcessoCompras::with(['modalidade', 'criterioJulgamento', 'situacao']);

        // Aplicar filtros (mesmo código do index)
        if ($request->filled('busca')) {
            $busca = $request->busca;
            $query->where(function($q) use ($busca) {
                $q->where('objeto', 'LIKE', "%{$busca}%")
                  ->orWhere('descricao', 'LIKE', "%{$busca}%")
                  ->orWhere('numero', 'LIKE', "%{$busca}%");
            });
        }

        if ($request->filled('modalidade')) {
            $query->where('modalidade_id', $request->modalidade);
        }

        if ($request->filled('criterio_julgamento')) {
            $query->where('criterio_julgamento_id', $request->criterio_julgamento);
        }

        if ($request->filled('situacao')) {
            $query->where('situacao_id', $request->situacao);
        }

        $processos = $query->orderBy('data_publicacao', 'desc')->get();

        // Preparar dados para exportação
        $dados = $processos->map(function($processo) {
            return [
                'Número' => $processo->numero,
                'Objeto' => $processo->objeto,
                'Modalidade' => $processo->modalidade->nome ?? 'N/A',
                'Critério de Julgamento' => $processo->criterioJulgamento->nome ?? 'N/A',
                'Situação' => $processo->situacao->nome ?? 'N/A',
                'Valor Estimado' => $processo->valor_estimado ? 'R$ ' . number_format($processo->valor_estimado, 2, ',', '.') : 'N/A',
                'Data de Abertura' => $processo->data_publicacao ? $processo->data_publicacao->format('d/m/Y H:i') : 'N/A',
                'Data de Criação' => $processo->created_at->format('d/m/Y H:i'),
            ];
        });

        // Gerar CSV
        $filename = 'licitacoes_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($dados) {
            $file = fopen('php://output', 'w');
            
            // BOM para UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Cabeçalhos
            if ($dados->isNotEmpty()) {
                fputcsv($file, array_keys($dados->first()), ';');
                
                // Dados
                foreach ($dados as $row) {
                    fputcsv($file, array_values($row), ';');
                }
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Retorna estatísticas para dashboard
     */
    public function estatisticas()
    {
        $stats = [
            'total_processos' => ProcessoCompras::count(),
            'processos_ativos' => ProcessoCompras::whereHas('situacao', function($q) {
                $q->where('finalizado', false);
            })->count(),
            'processos_finalizados' => ProcessoCompras::whereHas('situacao', function($q) {
                $q->where('finalizado', true);
            })->count(),
            'valor_total_estimado' => ProcessoCompras::sum('valor_estimado'),
            'processos_por_modalidade' => ProcessoCompras::select('modalidade_id')
                ->with('modalidade')
                ->groupBy('modalidade_id')
                ->selectRaw('modalidade_id, count(*) as total')
                ->get()
                ->mapWithKeys(function($item) {
                    return [$item->modalidade->nome ?? 'N/A' => $item->total];
                }),
            'processos_por_mes' => ProcessoCompras::selectRaw('YEAR(created_at) as ano, MONTH(created_at) as mes, count(*) as total')
                ->groupBy('ano', 'mes')
                ->orderBy('ano', 'desc')
                ->orderBy('mes', 'desc')
                ->limit(12)
                ->get()
                ->map(function($item) {
                    return [
                        'periodo' => sprintf('%02d/%d', $item->mes, $item->ano),
                        'total' => $item->total
                    ];
                })
        ];

        return response()->json($stats);
    }

    /**
     * Busca avançada com múltiplos critérios
     */
    public function buscaAvancada(Request $request)
    {
        $query = ProcessoCompras::with(['modalidade', 'criterioJulgamento', 'situacao']);

        // Busca por múltiplos campos
        if ($request->filled('termo')) {
            $termo = $request->termo;
            $query->where(function($q) use ($termo) {
                $q->where('objeto', 'LIKE', "%{$termo}%")
                  ->orWhere('descricao', 'LIKE', "%{$termo}%")
                  ->orWhere('numero', 'LIKE', "%{$termo}%")
                  ->orWhereHas('credenciamentos.dadoPessoa', function($subQ) use ($termo) {
                      $subQ->where('razao_social', 'LIKE', "%{$termo}%")
                           ->orWhere('nome_fantasia', 'LIKE', "%{$termo}%");
                  });
            });
        }

        // Filtros específicos
        if ($request->filled('modalidades')) {
            $query->whereIn('modalidade_id', $request->modalidades);
        }

        if ($request->filled('situacoes')) {
            $query->whereIn('situacao_id', $request->situacoes);
        }

        if ($request->filled('valor_min') || $request->filled('valor_max')) {
            $query->whereBetween('valor_estimado', [
                $request->valor_min ?? 0,
                $request->valor_max ?? PHP_INT_MAX
            ]);
        }

        if ($request->filled('data_inicio') || $request->filled('data_fim')) {
            $query->whereBetween('data_publicacao', [
                $request->data_inicio ?? '1900-01-01',
                $request->data_fim ?? '2100-12-31'
            ]);
        }

        // Ordenação
        $orderBy = $request->get('order_by', 'data_publicacao');
        $orderDirection = $request->get('order_direction', 'desc');
        
        $query->orderBy($orderBy, $orderDirection);

        $processos = $query->paginate($request->get('per_page', 15));

        return response()->json([
            'data' => $processos->items(),
            'pagination' => [
                'current_page' => $processos->currentPage(),
                'last_page' => $processos->lastPage(),
                'per_page' => $processos->perPage(),
                'total' => $processos->total(),
                'from' => $processos->firstItem(),
                'to' => $processos->lastItem()
            ]
        ]);
    }
}

