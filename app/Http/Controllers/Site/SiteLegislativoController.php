<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\AttachmentSession;
use App\Models\Categoria;
use App\Models\Commission;
use App\Models\CommissionMembers;
use App\Models\Councilor;
use App\Models\DirectorTable;
use App\Models\DirectorTableMemberFunctions;
use App\Models\Enquete;
use App\Models\Legislature;
use App\Models\Link;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use App\Models\SeemCommission;
use App\Models\Session;
use App\Models\Tenant;
use App\Models\TypeDocument;
use App\Models\TypeSession;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SiteLegislativoController extends Controller
{
    private $tenant, $menu, $link, $post, $category, $page,
    $legislature, $councilor, $session, $type_session, $type_document,
    $attachment_session, $commission, $seemCommission, $directorTable;
    public function __construct(
        Tenant $tenant, 
        Menu $menu, 
        Link $link, 
        Post $post, 
        Categoria $category,
        Page $page,
        Legislature $legislature,
        Councilor $councilor,
        Session $session,
        TypeSession $type_session,
        TypeDocument $type_document,
        AttachmentSession $attachment_session,
        Commission $commission,
        SeemCommission $seemCommission,
        DirectorTable $directorTable,
      
        )
    {
        $this->tenant = $tenant;
        $this->menu = $menu;
        $this->link = $link;
        $this->post = $post;
        $this->category = $category;
        $this->page = $page;
        $this->legislature = $legislature;
        $this->councilor = $councilor;
        $this->session = $session;
        $this->type_session = $type_session;
        $this->type_document = $type_document;
        $this->attachment_session = $attachment_session;
        $this->commission = $commission;
        $this->seemCommission = $seemCommission;
        $this->directorTable = $directorTable;
     
    }

    public function index(){

        $tenant = $this->tenant->first();       
        $menus = Menu::getMenusByPosition(1);  
        $menusSuperior = Menu::getMenusByPosition(2);                             

        $servicosOnline = $this->link->where('tipo', 2)->get();
        //pega os 4 link cadastrado para o topo ordenado pela ordem   
        $linksTopo = $this->link
                            ->where('posicao', 2)
                            ->where('tipo', 1) //Tipo = Banner
                            ->orderby('ordem', 'ASC')
                            ->orderby('created_at')
                            ->take(4)
                            ->get();
        //pega os 4 link cadastrado para o inferiorao slide
        $linksInferior = $this->link
                            ->where('posicao', 4) // link inferior ao slide
                            ->where('tipo', 1) //Tipo = Banner
                            ->orderby('ordem', 'ASC')
                            ->orderby('created_at')
                            ->take(6)
                            ->get();  
        //pega os 6 link cadastrado para o lado direito ordenado pela ordem   
        $linksDireita = $this->link
                            ->where('posicao', 3)
                            ->where('tipo', 1) //Tipo = Banner
                            ->orderby('ordem', 'ASC')
                            ->orderby('created_at')
                            ->take(6)
                            ->get(); 
        $linksUteis = $this->link                            
                            ->where('tipo', 2) //Tipo = Links Úteis
                            ->orderby('ordem', 'ASC')
                            ->orderby('created_at')                            
                            ->get();
        $posts_destaque = $this->post->where('destaque', 1)
                            ->where(function ($query) {
                                $query->whereNull('data_expiracao')
                                ->orWhere('data_expiracao', '>=', now());
                            })
                            ->get();


        $ultimasNoticias = $this->post->take(4)->orderBy('created_at', 'DESC')->get();
        
        // Busca uma enquete ativa
        $enquete = Enquete::where('situacao', 1)->latest()->first();
        return view('site.legislativo.index',[
            'tenant' => $tenant,
            'menus' => $menus,
            'servicosOnline' => $servicosOnline,
            'linksTopo' => $linksTopo,
            'linksDireita' => $linksDireita,
            'posts_destaque' => $posts_destaque,
            'linksUteis' => $linksUteis,
            'ultimasNoticias' => $ultimasNoticias,
            'linksInferior' => $linksInferior,
            'menusSuperior' => $menusSuperior,
            'enquete' => $enquete,
        ]);
    }
  

    public function legislaturas(){ // rota = camara.legislatura
        $tenant = $this->tenant->first();            
        $menus = Menu::getMenusByPosition(1);  
        $menusSuperior = Menu::getMenusByPosition(2);
        $servicosOnline = $this->link->where('tipo', 2)->get();
        $linksDireita = $this->link
                ->where('posicao', 3)
                ->where('tipo', 1) //Tipo = Banner
                ->orderby('ordem', 'ASC')
                ->orderby('created_at')
                ->take(4)
                ->get(); 
        $linksUteis = $this->link                            
                ->where('tipo', 2) //Tipo = Links Úteis
                ->orderby('ordem', 'ASC')
                ->orderby('created_at')                            
                ->get(); 
        $legislatures = $this->legislature->orderby('data_inicio', 'DESC')->get();
        
        return view('site.legislativo.legislatures', [            
            'tenant' =>$tenant,     
            'menus' => $menus,  
            'linksDireita' => $linksDireita,
            'linksUteis' => $linksUteis,
            'legislatures' => $legislatures,
            'menusSuperior' => $menusSuperior,
        ]);
    }
    public function legislatura($id){ // rota = camara.legislatura
        $tenant = $this->tenant->first();            
        $menus = Menu::getMenusByPosition(1);  
        $menusSuperior = Menu::getMenusByPosition(2);
        $servicosOnline = $this->link->where('tipo', 2)->get();
        $linksDireita = $this->link
                ->where('posicao', 3)
                ->where('tipo', 1) //Tipo = Banner
                ->orderby('ordem', 'ASC')
                ->orderby('created_at')
                ->take(4)
                ->get(); 
        $linksUteis = $this->link                            
                ->where('tipo', 2) //Tipo = Links Úteis
                ->orderby('ordem', 'ASC')
                ->orderby('created_at')                            
                ->get(); 

        $legislature = $this->legislature->where('id', $id)->first();
        
        return view('site.legislativo.legislature', [            
            'tenant' =>$tenant,     
            'menus' => $menus,  
            'linksDireita' => $linksDireita,
            'linksUteis' => $linksUteis,
            'legislature' => $legislature,
            'menusSuperior' =>$menusSuperior
        ]);
    }


    public function vereador($id){ 

       
        $tenant = $this->tenant->first();            
        $menus = Menu::getMenusByPosition(1);  
        $menusSuperior = Menu::getMenusByPosition(2);
        $servicosOnline = $this->link->where('tipo', 2)->get();
        $linksDireita = $this->link
                ->where('posicao', 3)
                ->where('tipo', 1) //Tipo = Banner
                ->orderby('ordem', 'ASC')
                ->orderby('created_at')
                ->take(4)
                ->get();
        $linksUteis = $this->link                            
                ->where('tipo', 2) //Tipo = Links Úteis
                ->orderby('ordem', 'ASC')
                ->orderby('created_at')                            
                ->get(); 

        
        $vereador = $this->councilor->where('id', $id)->first();
       
        
        return view('site.legislativo.vereador', [            
            'tenant' =>$tenant,     
            'menus' => $menus,  
            'linksDireita' => $linksDireita,
            'linksUteis' => $linksUteis,
            'vereador' => $vereador,           
            'menusSuperior' => $menusSuperior,
        ]);
    }
    public function sessoes(Request $request)
    {
        $tenant = $this->tenant->first();            
        $menus = Menu::getMenusByPosition(1);  
        $menusSuperior = Menu::getMenusByPosition(2);
				
        $servicosOnline = $this->link->where('tipo', 2)->get();
        $linksDireita = $this->link
                ->where('posicao', 3)
                ->where('tipo', 1) //Tipo = Banner
                ->orderby('ordem', 'ASC')
                ->orderby('created_at')
                ->take(4)
                ->get(); 
        $linksUteis = $this->link                            
                ->where('tipo', 2) //Tipo = Links Úteis
                ->orderby('ordem', 'ASC')
                ->orderby('created_at')                            
                ->get(); 
        $tipos_sessao = $this->type_session->all();
        $legislaturas = $this->legislature->all();
        $councilors = $this->councilor->all();

        $filters = $request->except('_token');

        $sessoes = $this->session
            ->when($request->type_session_id, function ($query, $role) {
                return $query->where('type_session_id', $role);
            })
            ->when($request->legislature_id, function ($query, $role) {
                return $query->where('legislature_id', $role);
            })
            ->orderBy('data', 'DESC')
            ->paginate(10);

        return view('site.legislativo.sessoes', [
            'sessoes' => $sessoes,
            'tenant' =>  $tenant,
            'tipos_sessao' => $tipos_sessao,
            'legislaturas' => $legislaturas,
            'councilors' => $councilors,
            'menus' => $menus,  
            'linksDireita' => $linksDireita,
            'linksUteis' => $linksUteis,
            'filters' => $filters,
            'menusSuperior' => $menusSuperior,
        ]);
    }

    public function documentosSessoes(Request $request)
     {
 
        $tenant = $this->tenant->first();            
        $menus = Menu::getMenusByPosition(1);  
        $menusSuperior = Menu::getMenusByPosition(2);
        $servicosOnline = $this->link->where('tipo', 2)->get();
        $linksDireita = $this->link
                ->where('posicao', 3)
                ->where('tipo', 1) //Tipo = Banner
                ->orderby('ordem', 'ASC')
                ->orderby('created_at')
                ->take(4)
                ->get(); 
        $linksUteis = $this->link                            
                ->where('tipo', 2) //Tipo = Links Úteis
                ->orderby('ordem', 'ASC')
                ->orderby('created_at')                            
                ->get(); 
        
        $sessoes = $this->session->all();
        
        $tipos_sessao = $this->type_session->all();
        $legislaturas = $this->legislature->all();
        $tipos_documento = $this->type_document->all();
 
 
         $anexos = $this->attachment_session
             //->when('type_document_id', $request->type_document_id)
             ->when($request->type_document_id, function ($query, $role) {
                 return $query->where('type_document_id', $role);
             })
             ->when($request->data_inicio, function ($query, $role) {
                 return $query->where('created_at', '>=', $role);
             })
             ->when($request->data_fim, function ($query, $role) {
                 return $query->where('created_at', '<=', $role);
             })
             ->orderBy('created_at', 'DESC')
             ->paginate(10);
 
         $filters = $request->except('_token');
         return view('site.legislativo.documentosSessoes', [
             'sessoes' => $sessoes,
             'tenant' =>  $tenant,
             'filters' => $filters,
             'tipos_sessao' => $tipos_sessao,
             'legislaturas' => $legislaturas,
             'anexos' => $anexos,
             'tipos_documento' => $tipos_documento,
             'menus' => $menus,  
             'linksDireita' => $linksDireita,
             'linksUteis' => $linksUteis,
             'filters' => $filters,
             'menusSuperior' => $menusSuperior,
 
         ]);
     }
     public function pareceres(Request $request)
     {

         $tenant = $this->tenant->first();            
         $menus = Menu::getMenusByPosition(1);  
         $menusSuperior = Menu::getMenusByPosition(2);
         $servicosOnline = $this->link->where('tipo', 2)->get();
         $linksDireita = $this->link
                 ->where('posicao', 3)
                 ->where('tipo', 1) //Tipo = Banner
                 ->orderby('ordem', 'ASC')
                 ->orderby('created_at')
                 ->take(4)
                 ->get(); 
         $linksUteis = $this->link                            
                 ->where('tipo', 2) //Tipo = Links Úteis
                 ->orderby('ordem', 'ASC')
                 ->orderby('created_at')                            
                 ->get(); 

        
         $commissions = $this->commission->all();      
         $seemCommissions = $this->seemCommission->orderBy('created_at', 'DESC')->paginate(10);          
 
         $filters = $request->except('_token');
 
         $seemCommissions = $this->seemCommission
            ->when($request->commission_id, function ($query, $role) {
                return $query->where('commission_id', $role);
            })
            ->when($request->data_inicio, function ($query, $role) {
                return $query->where('created_at', '>=', $role);
            })
            ->when($request->data_fim, function ($query, $role) {
                return $query->where('created_at', '<=', $role);
            })
            ->when($request->ano, function ($query, $role) {
                return $query->whereYear('data', $role);
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
 
         return view('site.legislativo.pareceresComissao', [
             'seemCommissions' => $seemCommissions,           
          
             'tenant' =>  $tenant,
             'commissions' => $commissions,
             'menus' => $menus,  
             'linksDireita' => $linksDireita,
             'linksUteis' => $linksUteis,
             'filters' => $filters,
             'menusSuperior' => $menusSuperior,
         ]);
     }

     public function parecerShow($id){
         $tenant = $this->tenant->first();            
         $menus = Menu::getMenusByPosition(1);  
         $menusSuperior = Menu::getMenusByPosition(2);
         $servicosOnline = $this->link->where('tipo', 2)->get();
         $linksDireita = $this->link
                 ->where('posicao', 3)
                 ->where('tipo', 1) //Tipo = Banner
                 ->orderby('ordem', 'ASC')
                 ->orderby('created_at')
                 ->take(4)
                 ->get();         
         $linksUteis = $this->link                            
                 ->where('tipo', 2) //Tipo = Links Úteis
                 ->orderby('ordem', 'ASC')
                 ->orderby('created_at')                            
                 ->get(); 

        
         $commissions = $this->commission->all();    
          
         
         
        $seemCommission =  $this->seemCommission->where('id', $id)->first();

        if (!$seemCommission)
            return redirect()->back();
     

        return view('site.legislativo.pareceresShow', [
            'seemCommission' => $seemCommission,           
         
            'tenant' =>  $tenant,
            'commissions' => $commissions,
            'menus' => $menus,  
            'linksDireita' => $linksDireita,
            'linksUteis' => $linksUteis,  
            'menusSuperior' => $menusSuperior,          
        ]);

    }

    public function comissoes(){
      
        $tenant = $this->tenant->first();            
        $menus = Menu::getMenusByPosition(1);  
        $menusSuperior = Menu::getMenusByPosition(2);             
      
        $linksDireita = $this->link
            ->where('posicao', 3)
            ->where('tipo', 1) //Tipo = Banner
            ->orderby('ordem', 'ASC')
            ->orderby('created_at')
            ->take(4)
            ->get(); 
        $linksUteis = $this->link                            
            ->where('tipo', 2) //Tipo = Links Úteis
            ->orderby('ordem', 'ASC')
            ->orderby('created_at')                            
            ->get(); 


        //$directorTables = $this->directorTable->where('atual', 1)->get();

        $commissions = $this->commission->get();
        //pega os membros das comissões        
        foreach ($commissions as $comissao) {
            $id = $comissao->id;
            $membrosComissao[] = CommissionMembers::with('members', 'functions')->where('commission_id', $id)->get();
        }
        return view('site.legislativo.comissoes', [            
            'tenant' =>  $tenant,            
            'menus' => $menus,  
            'linksDireita' => $linksDireita,
            'linksUteis' => $linksUteis,
            'commissions' => $commissions,
            'membrosComissao' => $membrosComissao,
            'menusSuperior' => $menusSuperior,
        ]);
    }
    public function mesaDiretora(){    
       
        $tenant = $this->tenant->first();            
        $menus = Menu::getMenusByPosition(1);  
        $menusSuperior = Menu::getMenusByPosition(2);
        $linksDireita = $this->link
            ->where('posicao', 3)
            ->where('tipo', 1) //Tipo = Banner
            ->orderby('ordem', 'ASC')
            ->orderby('created_at')
            ->take(4)
            ->get(); 
        $linksUteis = $this->link             
            ->where('tipo', 2) //Tipo = Links Úteis
            ->orderby('ordem', 'ASC')
            ->orderby('created_at')                            
            ->get();
       

        $directorTables = $this->directorTable->orderBy('created_at', 'DESC')->get();
        //pega os membros das comissões        
        foreach ($directorTables as $mesaDiretora) {
            $id = $mesaDiretora->id;
            $membrosMesaDiretora[] = DirectorTableMemberFunctions::with('members', 'functions')->where('director_table_id', $id)->get();
        }       
        return view('site.legislativo.mesaDiretora', [            
            'tenant' =>  $tenant,            
            'menus' => $menus,  
            'linksDireita' => $linksDireita,
            'linksUteis' => $linksUteis,
            'directorTables' => $directorTables,  
            'membrosMesaDiretora' => $membrosMesaDiretora,  
            'menusSuperior' => $menusSuperior,
           
        ]);
    }

}
