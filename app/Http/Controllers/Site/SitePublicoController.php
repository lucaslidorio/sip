<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Councilor;
use App\Models\Functions;
use App\Models\Legislature;
use App\Models\Link;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use App\Models\ProceedingSituation;
use App\Models\Proposition;
use App\Models\Session;
use App\Models\Tenant;
use App\Models\TypeProposition;
use App\Models\TypeSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SitePublicoController extends Controller
{
    private $tenant, $menu, $link, $vereadores, $noticias, $categorias, $page, $vereador;
    

    public function __construct(
        Tenant $tenant, 
        Menu $menu, 
        Link $link, 
        Councilor $vereadores, 
        Post $noticias,
        Categoria $categorias,
        Page $page,
        Councilor $vereador,

        ){

        $this->tenant = $tenant;
        $this->menu = $menu;
        $this->link = $link;
        $this->vereadores = $vereadores;
        $this->noticias = $noticias;
        $this->categorias = $categorias;
        $this->page = $page;
        $this->vereador = $vereador;
    }

    
   
    public function index(){
        $template = view()->shared('currentTemplate');
        $tenant = $this->tenant->first();  
        $now = Carbon::now();
        $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
            ->orderBy('ordem')
            ->get();
        $menus3 = $this->menu::whereNull('menu_pai_id')
        ->where('posicao', '3')
        ->orderBy('ordem')
        ->get();
             
        $vereadores = $this->vereadores->where('atual', 1)->get();
        $noticias = $this->noticias    
            ->where(function ($query) {
                $query->where('data_expiracao', '>=', Carbon::now())
                    ->orWhereNull('data_expiracao');
            })
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($noticia) {
                $noticia->conteudo_truncado = Str::limit($noticia->conteudo, 100);
                return $noticia;
            });
        //recupera os post em destaque (slide principal)
        $posts_destaque = $this->noticias
            ->where('destaque', '1')
            ->where('data_expiracao', null)
            ->orWhere('data_expiracao', '>', $now)
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();
                    // Recupera os links da posição "Direita"
        $linksDireita = $this->link::porPosicao(3)->get(); // 3 corresponde a "Direita"
        // Recupera os links da posição "Inferior"
        $linksInferior = $this->link::porPosicao(4)->get(); // 4 corresponde a "Inferior"
        return view(
            "public_templates.$template.index",
            compact(
                'tenant', 
                'menus', 
                'linksDireita', 
                'linksInferior', 
                'vereadores', 
                'noticias', 
                'posts_destaque',
                'menus3'
                )
        );
    }

    public function noticiasTodas(Request $request)
    {       
               
        $dados = $request->only(['pesquisar', 'data_publicacao_inicial', 'data_publicacao_final', 'category_id']);
       
        $template = view()->shared('currentTemplate');
        $tenant = $this->tenant->first();  
        $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
            ->orderBy('ordem')
            ->get(); 
        $categorias = $this->categorias::withCount('posts')->get();      
        $noticias = (new Post())->noticiasPesquisar($dados)->appends($dados);    
             
        return view("public_templates.$template.includes.noticias.noticias_todas" ,compact(
            'noticias', 'tenant', 'menus',  'categorias'));
    }

    public function noticiaShow($url)
    {        
        
        $noticia = $this->noticias->where('url', $url)->first();
        $categorias = $this->categorias::withCount('posts')->get();
       
        if (!$noticia)
            return redirect()->back();
            $tenant = $this->tenant->first();
            $template = view()->shared('currentTemplate');            
            $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
            ->orderBy('ordem')
            ->get();  
            // Obter as 6 últimas notícias da mesma categoria
            $ultimasNoticias = $this->noticias
            ->whereHas('categories', function ($query) use ($noticia) {
                $query->whereIn('categorias.id', $noticia->categories->pluck('id')); // Qualifique o ID com 'categorias.id'
            })
            ->where('posts.id', '<>', $noticia->id) // Qualifique o ID com 'posts.id'
            ->where(function ($query) {
                $query->whereNull('data_expiracao') // Inclui posts sem data de expiração
                    ->orWhere('data_expiracao', '>=', Carbon::now()->format('Y-m-d')); // Inclui posts não expirados
            })
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

             return view("public_templates.$template.includes.noticias.noticias_show" ,compact(
                'noticia', 'tenant', 'menus', 'ultimasNoticias', 'categorias'));    
  
    }

    public function page($slug){          
     
        $page = $this->page->where('slug',$slug)->first();
        $template = view()->shared('currentTemplate'); 
     
        if(!$page){
           redirect()->back();               
        }            
        $tenant = $this->tenant->first();          
        $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
            ->orderBy('ordem')
            ->get();    
         return view("public_templates.$template.page", [
            'page' => $page,
            'tenant' =>$tenant,
            'menus' => $menus    
        
        ]);
    
    }
   

    // LEGISLATIVOS
    public function vereador($id){
        $vereador = Councilor::with(['proposituras.tipo', 'comissoes'])
        ->where('id', $id)
        ->firstOrFail();
     

        $template = view()->shared('currentTemplate'); 
        if(!$vereador){
            redirect()->back();               
         } 
         $tenant = $this->tenant->first();  
         $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
             ->orderBy('ordem')
             ->get();
        // Agrupa as proposituras por tipo e conta a quantidade de cada tipo
        $proposituras = $vereador->proposituras
            ->groupBy(function ($item) {
                return $item->tipo->id;
            })
            ->map(function ($items) {
                return [
                    'nome' => $items->first()->tipo->nome,
                    'quantidade' => $items->count(),
                ];
            });

        // Buscar as comissões e associar a função que o vereador ocupa nelas
        $comissoes = $vereador->comissoes->map(function ($comissao) {
            return [
                'nome' => $comissao->nome,
                'funcao' => Functions::find($comissao->pivot->function_id)->nome ?? 'Membro'
            ];
        });

             return view("public_templates.$template.includes.vereadores.vereador", compact(
                'vereador', 'tenant', 'menus', 'proposituras','comissoes' ));  
    }

    public function proposituras(Request $request)
    {
       
        $template = view()->shared('currentTemplate');

        $tenant = $this->tenant->first();
        $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
        ->orderBy('ordem')
        ->get();

        // Buscar vereadores, tipos de proposições e situações para os filtros
        $vereadores = Councilor::orderBy('nome')->get();
        $tipos = TypeProposition::orderBy('nome')->get();
        $situacoes = ProceedingSituation::orderBy('id')->get();

        // Iniciar a query
        $query = Proposition::query()->with(['tipo', 'situacao', 'autores']);

        // Aplicar filtros dinamicamente
        if ($request->filled('vereador')) {
            $query->whereHas('autores', function ($q) use ($request) {
                $q->where('councilor_id', $request->vereador);
            });
        }

        if ($request->filled('tipo')) {
            $query->where('type_proposition_id', $request->tipo);
        }

        if ($request->filled('situacao')) {
            $query->where('proceeding_situation_id', $request->situacao);
        }

        if ($request->filled('ano')) {
            $query->whereYear('data', $request->ano);
        }

        // Ordenação
        if ($request->filled('ordenacao') && in_array($request->ordenacao, ['asc', 'desc'])) {
            $query->orderBy('numero', $request->ordenacao);
        } else {
            $query->orderBy('data', 'desc'); // Padrão: data decrescente
        }

        $proposituras = $query->paginate(15);

      
        return view("public_templates.$template.includes.proposituras.proposituras", compact(
            'tenant',
            'menus',
            'proposituras',
            'vereadores',
            'tipos',
            'situacoes'
        ));       
        
    }


    public function proposituraShow($id)
    {
        $propositura = Proposition::with([
            'tipo',
            'situacao',
            'autores',
            'votos.vereador',
            'votos.tipoVoto',
            'votos.sessao'
        ])->findOrFail($id);
    



        if (!$propositura) {
            redirect()->back();
        }

        $template = view()->shared('currentTemplate');
        $tenant = $this->tenant->first();
        $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
            ->orderBy('ordem')
            ->get();
         // Buscar vereadores, tipos de proposições e situações para os filtros
         $vereadores = Councilor::orderBy('nome')->get();
         $tipos = TypeProposition::orderBy('nome')->get();
         $situacoes = ProceedingSituation::orderBy('id')->get();

            return view("public_templates.$template.includes.proposituras.propositura_show", compact(
                'tenant',
                'menus',
                'propositura',
                'vereadores',   
                'tipos',
                'situacoes'                
            ));
    }
    public function sessoes(Request $request)
    {

        $template = view()->shared('currentTemplate');
        $tenant = $this->tenant->first();
        $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
        ->orderBy('ordem')
        ->get();
        
        // Filtros disponíveis para os selects
        $tipos = TypeSession::all();
        $legislaturas = Legislature::all();
        // Buscar anos das sessoes existentes
        $anos = Session::whereNotNull('data')
        ->selectRaw('YEAR(data) as ano')
        ->groupBy('ano')
        ->orderByDesc('ano')
        ->pluck('ano'); 
    
        // Query base
        $query = Session::with(['tipo', 'legislatura'])
        ->orderBy('data', $request->ordenacao ?? 'desc');
    
        // Filtros
          
        if ($request->filled('type_session_id')) {
            $query->where('type_session_id', $request->type_session_id);
        }
    
        if ($request->filled('legislature_id')) {
            $query->where('legislature_id', $request->legislature_id);
        }
    
        if ($request->filled('ano')) {
            $query->whereYear('data', $request->ano);
        }
    
         // Pesquisa geral (nome)
         if ($request->filled('pesquisar')) {
            $pesquisa = $request->pesquisar;
        
            $query->where(function ($q) use ($pesquisa) {
                $q->where('nome', 'like', "%$pesquisa%")
                  ->orWhereHas('legislatura', function ($q2) use ($pesquisa) {
                      $q2->where('nome', 'like', "%$pesquisa%");
                  });
            });
        }
    
        $sessoes = $query->paginate(15)->appends($request->all());    
      
        return view("public_templates.$template.includes.sessoes.sessoes", compact(
            'tenant',
            'menus',
            'sessoes',            
            'tipos',
            'legislaturas',
            'anos'
        ));
    }

public function sessaoShow($id)
{

    $sessao = Session::with([
        'tipo',
        'legislatura.vereadores',
        'secao',
        'periodo',
        'anexos.typeDocument',
        'votos.propositura.tipo',
        'presencas.vereador'
    ])->findOrFail($id);
    
    if (!$sessao) {
        redirect()->back();
    }

    $template = view()->shared('currentTemplate');
    $tenant = $this->tenant->first();
    $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
        ->orderBy('ordem')
        ->get();
    // Filtros disponíveis para os selects
    $tipos = TypeSession::all();
    $legislaturas = Legislature::all();
    // Buscar anos das sessoes existentes
    $anos = Session::whereNotNull('data')
    ->selectRaw('YEAR(data) as ano')
    ->groupBy('ano')
    ->orderByDesc('ano')
    ->pluck('ano');    

    // IDs dos presentes
    $presentesIds = $sessao->presencas->pluck('councilor_id')->toArray();

    // Vereadores da legislatura da sessão
    $vereadoresLegislatura = $sessao->legislatura->vereadores ?? collect();

    // Presentes
    $presentes = $vereadoresLegislatura->filter(function ($vereador) use ($presentesIds) {
        return in_array($vereador->id, $presentesIds);
    });

    // Faltosos
    $faltaram = $vereadoresLegislatura->filter(function ($vereador) use ($presentesIds) {
        return !in_array($vereador->id, $presentesIds);
    });
   // Agrupa as proposituras votadas nessa sessão (evita duplicatas)
    $propositurasVotadas = $sessao->votos
    ->groupBy('proposition_id')
    ->map(fn($votos) => $votos->first()->propositura)
    ->filter(); // Remove nulos, se houver
   
        return view("public_templates.$template.includes.sessoes.sessao_show", compact(
            'tenant',
            'menus',
            'sessao',            
            'propositurasVotadas',
            'legislaturas',
            'anos',
            'tipos',
            'sessao',
            'presentes',
            'faltaram'
        ));
}




}
