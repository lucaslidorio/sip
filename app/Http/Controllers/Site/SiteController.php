<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\AttachmentSession;
use App\Models\Commission;
use App\Models\CommissionMembers;
use App\Models\Councilor;
use App\Models\DirectorTable;
use App\Models\DirectorTableMemberFunctions;
use App\Models\Functions;
use App\Models\Legislature;
use App\Models\Minute;
use App\Models\Post;
use App\Models\ProceedingSituation;
use App\Models\Proposition;
use App\Models\Section;
use App\Models\Session;
use App\Models\Tenant;
use App\Models\TypeDocument;
use App\Models\TypeMinutes;
use App\Models\TypeProposition;
use App\Models\TypeSession;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\AssignOp\Concat;
//use Mail;
use App\Mail\contato;
use App\Models\CitizenLetter;
use App\Models\CriterioJulgamento;
use App\Models\Enquete;
use App\Models\Legislation;
use App\Models\Link;
use App\Models\Menu;
use App\Models\Modalidades;
use App\Models\Page;
use App\Models\ProcessoCompras;
use App\Models\Schedule;
use App\Models\SeemCommission;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    private
        $tenant,
        $legislature,
        $councilor,
        $function,
        $directorTable,
        $commission,
        $post,
        $minute,
        $section,
        $type,
        $session,
        $type_session,
        $attachment_session,
        $type_document,
        $proposition,
        $type_proposition,
        $proceeding_situation,
        $citizen_letter,
        $legislation,
        $seemCommission,

        //Comuns
        $page,
        $menu,
        $link;

    public function __construct(
        Tenant $tenant,
        Legislature $legislature,
        Councilor $councilor,
        Functions $function,
        DirectorTable $directorTable,
        Commission $commission,
        Post $post,
        Minute $minute,
        Section $section,
        TypeMinutes $type,
        Session $session,
        TypeSession $type_session,
        AttachmentSession $attachment_session,
        TypeDocument $type_document,
        Proposition $proposition,
        TypeProposition $type_proposition,
        ProceedingSituation $proceeding_situation,
        CitizenLetter  $citizen_letter,
        Legislation $legislation,
        SeemCommission $seemCommission,

        //Comuns
        Page $page,
        Menu $menu,
        Link  $link,
    ) {
        $this->tenant = $tenant;
        $this->legislature = $legislature;
        $this->councilor = $councilor;
        $this->function = $function;
        $this->directorTable = $directorTable;
        $this->commission = $commission;
        $this->post = $post;
        $this->minute =  $minute;
        $this->section = $section;
        $this->type = $type;
        $this->session = $session;
        $this->type_session = $type_session;
        $this->attachment_session = $attachment_session;
        $this->type_document = $type_document;
        $this->proposition = $proposition;
        $this->type_proposition = $type_proposition;
        $this->proceeding_situation = $proceeding_situation;
        $this->citizen_letter = $citizen_letter; //carta ao cidadão
        $this->legislation = $legislation;
        $this->seemCommission = $seemCommission;

        //Funçoes Comuns
        $this->page = $page;
        $this->menu = $menu;
        $this->link = $link;

    }
    // Funções Comuns entre os site do Legislativo e Executivos

    public function page($slug){          
     
            $page = $this->page->where('slug',$slug)->first();
         
            if(!$page){
               redirect()->back();               
            }          
      
            $tenant = $this->tenant->first();            
           
            $menus = Menu::getMenusByPosition(1);  
            $menusSuperior = Menu::getMenusByPosition(2);     
                       
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
    
            
             return view('site.legislativo.page', [
                'page' => $page,
                'tenant' =>$tenant,     
                'menus' => $menus,  
                'linksDireita' => $linksDireita,
                'linksUteis' => $linksUteis,
                'menusSuperior' => $menusSuperior,
            ]);
        
    }

    public function index()
    {

        $tenants = $this->tenant->where('id', 3)->get();
        $legislatures = $this->legislature->where('atual', 1)->get();
        //pega as mesa diretoras
        $directorTables = $this->directorTable->where('atual', 1)->get();
        $commissions = $this->commission->get();
        //pega os membros das comissões        
        foreach ($commissions as $comissao) {
            $id = $comissao->id;
            $membrosComissao[] = CommissionMembers::with('members', 'functions')->where('commission_id', $id)->get();
        }

        $councilors = $this->councilor->where('atual', 1)->get();
        $now = Carbon::now(); //pega a data atual
        //recupera os post em destaque (slide principal)
        $posts_destaque = $this->post
            ->where('destaque', '1')
            ->where('data_expiracao', null)
            ->orWhere('data_expiracao', '>', $now)
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();


        //recupera as noticias e mostra na tela as 6 utimas para a galeria de noticias
        $posts = $this->post->where('data_expiracao', null)->orWhere('data_expiracao', '>', '2021-05-12')
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();
        $sessoes_count =  $this->session->count();
        $prositura_count = $this->proposition->count();

        //recurpea a carta ao cidadao
        $carta_cidadao = $this->citizen_letter->first();

        return view('site.layouts.app', [
            'tenants' => $tenants,
            'legislatures' => $legislatures,
            'directorTables' => $directorTables,
            'membrosComissao' => $membrosComissao,
            'commissions' => $commissions,
            'councilors' => $councilors,
            'posts_destaque' => $posts_destaque,
            'posts' => $posts,
            'sessoes_count' => $sessoes_count,
            'prositura_count' => $prositura_count,
            'carta_cidadao' => $carta_cidadao,

        ]);
    }

    public function vereadoresShow($nome)
    {

        $vereador = $this->councilor->where('nome', $nome)->first();

        if (!$vereador)
            return redirect()->back();

        $tenants = $this->tenant->where('id', 3)->get();
        $councilors = $this->councilor->where('atual', 1)->get();


        return view('site.layouts.vereadoresShow', [
            'tenants' =>  $tenants,
            'vereador' => $vereador,
            'councilors' => $councilors,
        ]);
    }

    public function noticiasTodasPesquisar(Request $request)
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
                ->take(6)
                ->get();
        $linksUteis = $this->link                            
                    ->where('tipo', 2) //Tipo = Links Úteis
                    ->orderby('ordem', 'ASC')
                    ->orderby('created_at')                            
                    ->get();
            
        $pesquisar = $request->except('_token');
           
        $posts = $this->post->noticiasPesquisar($request->pesquisar);

      
        $posts->each(function (&$post) {
            $post['conteudo_trucado'] = Str::of($post->conteudo)->limit(400);
            return $post;
        });
      
        

        $tenants = $this->tenant->where('id', 3)->get();
        return view('site.legislativo.noticias', [
            'posts' => $posts,
            'tenant' =>$tenant,     
            'menus' => $menus,  
            'linksDireita' => $linksDireita,
            'linksUteis' => $linksUteis,
            'servicosOnline' => $servicosOnline,
            'filters' => $pesquisar,
            'menusSuperior' => $menusSuperior,
        ]);
    }

    public function noticiaShow($url)
    {
        
        $post = $this->post->where('url', $url)->first();

        if (!$post)
            return redirect()->back();

            $tenant = $this->tenant->first();            
            $menus = Menu::getMenusByPosition(1);  
            $menusSuperior = Menu::getMenusByPosition(2);           
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
    
       
                    
        $posts = $this->post->where('secretary_id', $post->secretary_id)
            ->where(function ($query) {
                $query->where('data_expiracao', null)
                    ->orWhere('data_expiracao', '>=', Carbon::now()->format('d-m-Y'));
            })
            ->orderBy('created_at', 'DESC')
            ->limit(4)
            ->get();

        return view('site.legislativo.noticiaShow', [
            'post' => $post,
            'posts' => $posts,
            'tenant' =>$tenant,     
            'menus' => $menus,  
            'linksDireita' => $linksDireita,
            'linksUteis' => $linksUteis,
            'menusSuperior' => $menusSuperior,
            
        ]);
    }

    // public function sessoesIndex(Request $request)
    // {
    //     $sessoes = $this->session->all();
    //     $tenants = $this->tenant->where('id', 3)->get();
    //     $tipos_sessao = $this->type_session->all();
    //     $legislaturas = $this->legislature->all();
    //     $councilors = $this->councilor->all();

    //     $filters = $request->except('_token');

    //     $sessoes = $this->session
    //         ->when($request->type_session_id, function ($query, $role) {
    //             return $query->where('type_session_id', $role);
    //         })
    //         ->when($request->legislature_id, function ($query, $role) {
    //             return $query->where('legislature_id', $role);
    //         })
    //         ->orderBy('data', 'DESC')
    //         ->paginate(10);

    //     return view('site.layouts.sessoes', [
    //         'sessoes' => $sessoes,
    //         'tenants' =>  $tenants,
    //         'tipos_sessao' => $tipos_sessao,
    //         'legislaturas' => $legislaturas,
    //         'councilors' => $councilors,
    //         'filters' => $filters,
    //     ]);
    // }
    // public function documentosSessoesPesquisar(Request $request)
    // {

    //     $sessoes = $this->session->all();
    //     $tenants = $this->tenant->where('id', 3)->get();
    //     $tipos_sessao = $this->type_session->all();
    //     $legislaturas = $this->legislature->all();
    //     $tipos_documento = $this->type_document->all();


    //     $anexos_ordem_dia = $this->attachment_session
    //         //->when('type_document_id', $request->type_document_id)
    //         ->when($request->type_document_id, function ($query, $role) {
    //             return $query->where('type_document_id', $role);
    //         })
    //         ->when($request->data_inicio, function ($query, $role) {
    //             return $query->where('created_at', '>=', $role);
    //         })
    //         ->when($request->data_fim, function ($query, $role) {
    //             return $query->where('created_at', '<=', $role);
    //         })
    //         ->orderBy('created_at', 'DESC')
    //         ->paginate(10);

    //     $filters = $request->except('_token');
    //     return view('site.layouts.documentosSessoes', [
    //         'sessoes' => $sessoes,
    //         'tenants' =>  $tenants,
    //         'filters' => $filters,
    //         'tipos_sessao' => $tipos_sessao,
    //         'legislaturas' => $legislaturas,
    //         'anexos_ordem_dia' => $anexos_ordem_dia,
    //         'tipos_documento' => $tipos_documento,

    //     ]);
    // }
    public function proposituras(Request $request)
    {
      
        $tenant = $this->tenant->first();            
        $menus = Menu::getMenusByPosition(1);  
        $menusSuperior = Menu::getMenusByPosition(2);           
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
        $tipos_propositura = $this->type_proposition->all();
        $situacoes = $this->proceeding_situation->all();
        $tipos_documento = $this->type_document->all();

        $filters = $request->except('_token');
        $proposituras = $this->proposition
            ->when($request->type_proposition_id, function ($query, $role) {
                return $query->where('type_proposition_id', $role);
            })
            ->when($request->proceeding_situation_id, function ($query, $role) {
                return $query->where('proceeding_situation_id', $role);
            })
            ->when($request->ano, function ($query, $role) {
                return $query->whereYear('data', $role);
            })
            ->when($request->ordenacao, function ($query, $role) {
                return $query->orderBy('numero', $role);
            })
            //->orderBy('numero', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('site.legislativo.proposituras', [
            'tenant' => $tenant,
            'menus' => $menus,
            'linksDireita' => $linksDireita,
            'linksUteis' => $linksUteis,
            'tipos_propositura' => $tipos_propositura,
            'situacoes' => $situacoes,
            'tipos_documento' => $tipos_documento,
            'proposituras' => $proposituras,
            'filters' => $filters,
            'menusSuperior' => $menusSuperior,
        ]);
    }
    public function proposituraShow($id)
    {        
        $propositura =  $this->proposition->where('id', $id)->first();
        if (!$propositura)
            return redirect()->back();      
        $tenant = $this->tenant->first();
        
        //Votos da proposituras
        $sql = "SELECT                		
				c.nome as vereador,				
				tv.nome as voto
            FROM propositions AS p
            INNER JOIN voto_vereador_proposituras AS vvp ON vvp.proposition_id = p.id
            INNER JOIN councilors AS c ON vvp.councilor_id = c.id
            INNER JOIN tipo_votos AS tv ON vvp.tipo_voto_id = tv.id
            WHERE p.id = ?";
        $votos = DB::select($sql, [$id]);

        $menus = Menu::getMenusByPosition(1);  
        $menusSuperior = Menu::getMenusByPosition(2);            
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
        


        return view('site.legislativo.proposituraShow', [
            'propositura' => $propositura,
            'tenant' => $tenant,
            'menus' => $menus,
            'linksDireita' => $linksDireita,
            'linksUteis' => $linksUteis,
            'menusSuperior' => $menusSuperior,
            'votos'=>$votos
        ]);
    }
    // public function parecerPesquisar(Request $request){
        
    //     $commissions = $this->commission->all();
    //     $tenants = $this->tenant->where('id', 3)->get(); 

    //     $seemCommissions = $this->seemCommission->orderBy('created_at', 'DESC')->paginate(10);

    //     $filters = $request->except('_token');
    //     $seemCommissions = $this->seemCommission
    //         ->when($request->commission_id, function ($query, $role) {
    //             return $query->where('commission_id', $role);
    //         })
    //         ->when($request->data_inicio, function ($query, $role) {
    //             return $query->where('created_at', '>=', $role);
    //         })
    //         ->when($request->data_fim, function ($query, $role) {
    //             return $query->where('created_at', '<=', $role);
    //         })
    //         ->when($request->ano, function ($query, $role) {
    //             return $query->whereYear('data', $role);
    //         })
    //         ->orderBy('created_at', 'DESC')
    //         ->paginate(10);
          
    //     return view('site.layouts.pareceres',[
    //         'tenants' => $tenants,
    //         'seemCommissions'=> $seemCommissions,
    //         'commissions' => $commissions,
    //         'filters' => $filters,
    //     ]);
    // }
    // public function parecerShow($id){
    //     $tenants = $this->tenant->where('id', 3)->get(); 
    //     $seemCommission =  $this->seemCommission->where('id', $id)->first();

    //     if (!$seemCommission)
    //         return redirect()->back();
    //     $tenants = $this->tenant->where('id', 3)->get();


    //     return view('site.layouts.parecerShow', [
    //         'seemCommission' => $seemCommission,
    //         'tenants' =>  $tenants,
    //     ]);

    // }
    public function cartaCidadaoShow($id)
    {

        $carta_cidadao =  $this->citizen_letter->where('id', $id)->first();
        if (!$carta_cidadao)
            return redirect()->back();
        $tenants = $this->tenant->where('id', 3)->get();


        return view('site.layouts.cartaCidadaoShow', [
            'carta_cidadao' => $carta_cidadao,
            'tenants' =>  $tenants,
        ]);
    }
    public  function legislacoes(){
        $tenants = $this->tenant->where('id', 3)->get();
        //por enquanto só esta pegando o regimento interno id = 5
        $legislacoes = $this->legislation->where('type_legislation_id', 5)->paginate(10);

        return view('site.layouts.legislacoes', [
            'legislacoes' => $legislacoes,
            'tenants' =>  $tenants,
        ]);
    }
    public function legislacaoShow($id){
        $tenants = $this->tenant->where('id', 3)->get();
        $legislacao = $this->legislation->where('id', $id)->first();

        return view('site.layouts.legislacaoShow', [
            'legislacao' => $legislacao,
            'tenants' =>  $tenants,
        ]);

    }

    public function contato(Request $request)
    {
        //formulário de contato  
        $contato = new ContactForm($request);

        try {
            $contato->sendMail();
        } catch (\Throwable $th) {
            toast("Erro ao enviar e-mail! {$th->getMessage()}", 'error')->toToast('top');
            return back();
        }
        toast('E-mail enviado com sucesso!', 'success')->toToast('top');
        return back();
    }

    public  function agendaIndex(){
        
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
        //pega os 5 link cadastrado para o lado direito ordenado pela ordem   
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
          

        return view('site.legislativo.agenda', [
            'tenant' =>  $tenant,
            'menus' => $menus,
            'servicosOnline' => $servicosOnline,
            'linksUteis' => $linksUteis,
            'linksTopo' => $linksTopo,
            'linksDireita' => $linksDireita,
            'linksUteis' => $linksUteis,
            'menusSuperior' => $menusSuperior,
        ]);
    }


    public function agendaShow()
    {
        $dados['eventos'] = Schedule::all();
      
        return response()->json($dados['eventos']);
    }
    public function acessibilidade()
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
            ->take(6)
            ->get();
        $linksUteis = $this->link
            ->where('tipo', 2) //Tipo = Links Úteis
            ->orderby('ordem', 'ASC')
            ->orderby('created_at')
            ->get();

        return view('site.legislativo.acessibilidade', [
            
            'tenant' => $tenant,
            'menus' => $menus,
            'servicosOnline' => $servicosOnline,
            'linksDireita' => $linksDireita,
            'linksUteis' => $linksUteis,
            'menusSuperior' => $menusSuperior,
        ]);
    }

    public function mapasite()
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
            ->take(6)
            ->get();
        $linksUteis = $this->link
            ->where('tipo', 2) //Tipo = Links Úteis
            ->orderby('ordem', 'ASC')
            ->orderby('created_at')
            ->get();

        return view('site.legislativo.mapasite', [
            
            'tenant' => $tenant,
            'menus' => $menus,
            'servicosOnline' => $servicosOnline,
            'linksDireita' => $linksDireita,
            'linksUteis' => $linksUteis,
            'menusSuperior' => $menusSuperior,
        ]);
    }


    public function pesquisar(Request $request){

        $tenant = $this->tenant->first();            
        $menus = Menu::getMenusByPosition(1);  
        $menusSuperior = Menu::getMenusByPosition(2);
        $servicosOnline = $this->link->where('tipo', 2)->get();
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
            
        $pesquisar = $request->pesquisar;

    

        $resultadoPosts = Post::where(function ($query) use ($pesquisar) {
                        $query->where('titulo', 'like', '%'.$pesquisar.'%')
                            ->orWhere('conteudo', 'like', '%'.$pesquisar.'%');
                        })
                        ->get()
                        ->map(function ($registro) {
                            $registro['tabela'] = 'Notícias';
                            $registro['conteudo'] = Str::limit($registro['conteudo'], 10);
                            $registro['url'] = 'noticias/' . $registro['url'];
                            return $registro;
                       });       
       
        $resultadoSessions = Session::where('nome', 'like', '%' . $pesquisar . '%')
                         ->orWhere('descricao', 'like', '%'.$pesquisar.'%')
                        ->get()
                        ->map(function ($registro) {
                            $registro['tabela'] = 'Sessões';
                            $registro['url'] = 'camara/sessoes';
                            return $registro;
                        });
                        
        $resultadoCouncilors = Councilor::where('nome', 'like', '%' . $pesquisar . '%')
                            ->orWhere('nome_parlamentar', 'like', '%'.$pesquisar.'%')
                            ->get()
                            ->map(function ($registro) {
                                $registro['tabela'] = 'Vereadores';
                                $registro['biografia'] = Str::limit($registro['conteudo'], 200);
                                $registro['url'] = '/vereadores/show/' . $registro['id'];
                                return $registro;
                            });
                           
        $resultadoPropositions = Proposition::where('descricao', 'like', '%' . $pesquisar . '%')
                                ->get()
                                ->map(function ($registro) {
                                    $registro['tabela'] = 'Proposituras';
                                    $registro['url'] = '/proposituras/' . $registro['id'];
                                    return $registro;
                                });
                                
       $resultadoLegislations = Legislation::where('caput', 'like', '%' . $pesquisar . '%')
                                ->orWhere('descricao', 'like', '%'.$pesquisar.'%')
                                ->get()
                                ->map(function ($registro) {
                                    $registro['tabela'] = 'Legislação';
                                    $registro['url'] = '/proposituras/' . $registro['id'];
                                    return $registro;
                                });                       
       $resultadoLesgilatures = Proposition::where('descricao', 'like', '%' . $pesquisar . '%')
                                ->get()
                                ->map(function ($registro) {
                                    $registro['tabela'] = 'Legislatura';
                                    $registro['url'] = '/proposituras/' . $registro['id'];
                                    return $registro;
                                });   

            $resultados = $resultadoPosts
            ->concat($resultadoSessions)
            ->concat($resultadoCouncilors)
            ->concat($resultadoLegislations)
            ->concat($resultadoLesgilatures)
            ->concat($resultadoPropositions);
            
        
        // return $resultados;
        // $tenants = $this->tenant->where('id', 3)->get();
        return view('site.legislativo.pesquisas', [
            'resultados' => $resultados,
            'tenant' =>$tenant,     
            'menus' => $menus,  
            'linksDireita' => $linksDireita,
            'linksUteis' => $linksUteis,
            'servicosOnline' => $servicosOnline,
            'filters' => $pesquisar,
            'menusSuperior' => $menusSuperior,
        ]);
    }

    public function processosComprasIndex(Request $request)
{
    $tenant = $this->tenant->first();            
    $menus = Menu::getMenusByPosition(1);  
    $menusSuperior = Menu::getMenusByPosition(2);				
    $linksDireita = $this->link
        ->where('posicao', 3)
        ->where('tipo', 1) // Tipo = Banner
        ->orderby('ordem', 'ASC')
        ->orderby('created_at')
        ->take(4)
        ->get(); 
    $linksUteis = $this->link                            
        ->where('tipo', 2) // Tipo = Links Úteis
        ->orderby('ordem', 'ASC')
        ->orderby('created_at')                            
        ->get();

    $modalidades = Modalidades::get();
    $criteriosJulgamento = CriterioJulgamento::get();
    $situacoes = ProceedingSituation::where('processo_compra', true)->get();

    // Filtrar os processos por modalidade e situação
    $filters = $request->only('modalidade_id', 'criterio_julgamento_id', 'proceeding_situation_id', 'pesquisa');
    
    // Aplicar os filtros e carregar os processos com credenciamentos e suas movimentações
    $processos = ProcessoCompras::filter($filters)
        ->with(['credenciamentos.movimentacoes.tipoMovimentacao'])
        ->paginate(10);

    // Filtrar os credenciamentos que têm a última movimentação com tipo_movimentacao_id = 5
    foreach ($processos as $processo) {
        $processo->credenciamentos = $processo->credenciamentos->filter(function ($credenciamento) {
            $ultimaMovimentacao = $credenciamento->movimentacoes->sortByDesc('created_at')->first();
            return $ultimaMovimentacao && $ultimaMovimentacao->tipo_movimentacao_id == 5;
        });
    }

    return view('site.legislativo.processosCompras', [            
        'tenant' =>  $tenant,          
        'menus' => $menus,  
        'linksDireita' => $linksDireita,
        'linksUteis' => $linksUteis,
        'filters' => $filters,
        'menusSuperior' => $menusSuperior,
        'modalidades' => $modalidades,
        'processos' => $processos,
        'criteriosJulgamento' => $criteriosJulgamento,
        'situacoes' => $situacoes
    ]);
}

public function votar(Request $request, $id)
{
    

    
    $enquete = Enquete::findOrFail($id);

    // Validação do item selecionado
    $request->validate([
        'item_id' => 'required|exists:itens_enquete,id'
    ]);

    // Incrementa o número de votos para o item selecionado
    $item = $enquete->itens()->where('id', $request->input('item_id'))->first();
    $item->increment('votos');

    return redirect()->route('enquete.resultado', $enquete->id);
}

public function resultadoEnquete($id)
{
    $tenant = $this->tenant->first();            
    $menus = Menu::getMenusByPosition(1);  
    $menusSuperior = Menu::getMenusByPosition(2);				
    $linksDireita = $this->link
        ->where('posicao', 3)
        ->where('tipo', 1) // Tipo = Banner
        ->orderby('ordem', 'ASC')
        ->orderby('created_at')
        ->take(4)
        ->get(); 
    $linksUteis = $this->link                            
        ->where('tipo', 2) // Tipo = Links Úteis
        ->orderby('ordem', 'ASC')
        ->orderby('created_at')                            
        ->get();
    $enquete = Enquete::with('itens')->findOrFail($id);
    // Calcular a quantidade total de votos
    $totalVotos = $enquete->itens->sum('votos');

    return view('site.legislativo.resultadoEnquete', compact(
        'enquete',
        'tenant',
        'menus',
        'menusSuperior',
        'linksDireita',
        'linksUteis',
        'totalVotos'
    ));
}


}
