<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Link;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SiteExecutivoController extends Controller
{
    private $tenant, $menu, $link, $post, $category;
    public function __construct(Tenant $tenant, Menu $menu, Link $link, Post $post, Categoria $category)
    {
        $this->tenant = $tenant;
        $this->menu = $menu;
        $this->link = $link;
        $this->post = $post;
        $this->category = $category;
        
    }

    public function index(){

        $tenant = $this->tenant->first();
        $menus = $this->menu
                ->where('menu_pai_id', null)
                ->where('posicao', 1) // Menu lateral
                ->get();
        $servicosOnline = $this->link->where('tipo', 2)->get();
        $linksUteis = $this->link->where('tipo', 1)->orderby('ordem', 'ASC')->get();
        $posts =  $this->post->where('destaque', 1)->get();

        return view('site.executivo.index',[
            'tenant' => $tenant,
            'menus' => $menus,
            'servicosOnline' => $servicosOnline,
            'linksUteis' => $linksUteis,
            'posts' => $posts
        ]);
    }

    public function noticias($url = null){
        $categoria = null;          
        if($url){    
            $categoria =  $this->category->where('url', $url)->first(); // pega uma categoria especifica
            $posts = $categoria->posts()
            ->paginate(12);
        } else{
            $posts = $this->post
            ->where(function ($query) {
                $query->where('data_expiracao', null)
                    ->orWhere('data_expiracao', '>=', Carbon::now()->format('d-m-Y'));
            })
            ->orderBy('created_at', 'DESC')            
            ->paginate(12);
        } 
        $tenant = $this->tenant->first();
        $menus = $this->menu
                ->where('menu_pai_id', null)
                ->where('posicao', 1) // Menu lateral
                ->get();     
        $categories =  $this->category->get();
          




        return view('site.executivo.noticias',[
            'tenant' => $tenant,
            'menus' => $menus,
            'categories' => $categories,
            'categoria' => $categoria,
            'posts' => $posts
            
        ]);
    }

    public function noticiaShow($url){
        $post =  $this->post->where('url', $url)->first();
        if(!$post){
            redirect()->back();
        }      
        $tenant = $this->tenant->first();
        $menus = $this->menu
                ->where('menu_pai_id', null)
                ->where('posicao', 1) // Menu lateral
                ->get();
        // $servicosOnline = $this->link->where('tipo', 2)->get();
        // $linksUteis = $this->link->where('tipo', 1)->orderby('ordem', 'ASC')->get();
        $posts = $this->post
            ->where(function ($query) {
                $query->where('data_expiracao', null)
                    ->orWhere('data_expiracao', '>=', Carbon::now()->format('d-m-Y'));
            })
            ->orderBy('created_at', 'DESC')            
            ->paginate(12);
        
        $noticiaAnterior = $this->post->noticiaAnterior($post->id);
        
       // $posts =  $this->post->where()->orderBy('created_at')->get();
       
        $categories =  $this->category->get();

        //dd($categories);
        return view('site.executivo.noticia-show',[
            'tenant' => $tenant,
            'menus' => $menus,
            'post' =>  $post,
            'posts' => $posts,
            'categories' => $categories,
            
        ]);
    }
}
