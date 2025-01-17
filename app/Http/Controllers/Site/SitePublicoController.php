<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Councilor;
use App\Models\Link;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SitePublicoController extends Controller
{
    private $tenant, $menu, $link, $vereadores, $noticias, $categorias;
    

    public function __construct(
        Tenant $tenant, 
        Menu $menu, 
        Link $link, 
        Councilor $vereadores, 
        Post $noticias,
        Categoria $categorias
        ){

        $this->tenant = $tenant;
        $this->menu = $menu;
        $this->link = $link;
        $this->vereadores = $vereadores;
        $this->noticias = $noticias;
        $this->categorias = $categorias;
    }

    
   
    public function index(){
        $template = view()->shared('currentTemplate');
        $tenant = $this->tenant->first();  
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
            ->limit(4)
            ->get()
            ->map(function ($noticia) {
                $noticia->conteudo_truncado = Str::limit($noticia->conteudo, 100);
                return $noticia;
            });
        // Recupera os links da posição "Direita"
        $linksDireita = $this->link::porPosicao(3)->get(); // 3 corresponde a "Direita"
        return view("public_templates.$template.index", 
                compact('tenant', 'menus', 'linksDireita', 'vereadores', 'noticias'));
    }

    public function noticiasTodas(Request $request)
    {        
        
        $pesquisar = $request->except('_token');
        $template = view()->shared('currentTemplate');
        $tenant = $this->tenant->first();  
        $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
            ->orderBy('ordem')
            ->get(); 
        $categorias = $this->categorias::withCount('posts')->get();       
          
        $noticias = $this->noticias->noticiasPesquisar($request->pesquisar);
      
        // $noticias->each(function (&$noticia) {
        //     $noticia['conteudo_trucado'] = Str::of($noticia->conteudo)->limit(400);
        //     return $noticia;
        // });      
             
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
            $linksDireita = $this->link::porPosicao(3)->get(); // 3 corresponde a "Direita"

            $noticias_vinculadas = $this->noticias->where('secretary_id', $noticia->secretary_id)
            ->where(function ($query) {
                $query->where('data_expiracao', null)
                    ->orWhere('data_expiracao', '>=', Carbon::now()->format('d-m-Y'));
            })
            
            ->orderBy('created_at', 'DESC')
            ->limit(4)
            ->get();
            return view("public_templates.$template.includes.noticias.noticias_show" ,compact(
                'noticia', 'tenant', 'menus', 'linksDireita', 'noticias_vinculadas', 'categorias'));
         
                   
        

       
    }
    


}
