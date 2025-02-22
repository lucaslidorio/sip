<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Councilor;
use App\Models\Link;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SitePublicoController extends Controller
{
    private $tenant, $menu, $link, $vereadores, $noticias, $categorias, $page;
    

    public function __construct(
        Tenant $tenant, 
        Menu $menu, 
        Link $link, 
        Councilor $vereadores, 
        Post $noticias,
        Categoria $categorias,
        Page $page,
        ){

        $this->tenant = $tenant;
        $this->menu = $menu;
        $this->link = $link;
        $this->vereadores = $vereadores;
        $this->noticias = $noticias;
        $this->categorias = $categorias;
        $this->page = $page;
    }

    
   
    public function index(){
        $template = view()->shared('currentTemplate');
        $tenant = $this->tenant->first();  
        $now = Carbon::now();
        $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
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
        return view("public_templates.$template.index", 
                compact('tenant', 'menus', 'linksDireita', 'linksInferior', 'vereadores', 'noticias', 'posts_destaque'));
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
    


}
