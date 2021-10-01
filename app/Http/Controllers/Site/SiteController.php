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
use App\Models\Legislation;
use App\Models\SeemCommission;

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
        $seemCommission;

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

    public function noticiasTodas()
    {
        $now = Carbon::now(); //pega a data atual
        //recupera os post em destaque (slide principal)
        $posts_destaque = $this->post
            ->where('destaque', '1')
            ->where('data_expiracao', null)
            ->orWhere('data_expiracao', '>', $now)
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();

        $tenants = $this->tenant->where('id', 3)->get();
        $now = Carbon::now(); //pega a data atual
        $posts = $this->post->where('data_expiracao', null)->orWhere('data_expiracao', '>', $now)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('site.layouts.noticiasTodas', [
            'posts' => $posts,
            'tenants' =>  $tenants,
            'posts_destaque' => $posts_destaque,
        ]);
    }
    public function noticiasTodasPesquisar(Request $request)
    {
        $pesquisar = $request->except('_token');
        //dd($pesquisar);
        $posts = $this->post->noticiasTodasPesquisar($request->pesquisa);

        $tenants = $this->tenant->where('id', 3)->get();
        return view('site.layouts.noticiasTodas', [
            'posts' => $posts,
            'pesquisar' => $pesquisar,
            'tenants' =>  $tenants,
        ]);
    }

    public function noticiaShow($url)
    {

        $post = $this->post->where('url', $url)->first();

        if (!$post)
            return redirect()->back();

        $tenants = $this->tenant->where('id', 3)->get();
        $posts = $this->post->where('secretary_id', $post->secretary_id)
            ->where(function ($query) {
                $query->where('data_expiracao', null)
                    ->orWhere('data_expiracao', '>=', Carbon::now()->format('d-m-Y'));
            })
            ->orderBy('created_at', 'DESC')
            ->limit(4)
            ->get();

        return view('site.layouts.noticiaShow', [
            'post' => $post,
            'posts' => $posts,
            'tenants' =>  $tenants,
        ]);
    }

    public function sessoesIndex(Request $request)
    {
        $sessoes = $this->session->all();
        $tenants = $this->tenant->where('id', 3)->get();
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

        return view('site.layouts.sessoes', [
            'sessoes' => $sessoes,
            'tenants' =>  $tenants,
            'tipos_sessao' => $tipos_sessao,
            'legislaturas' => $legislaturas,
            'councilors' => $councilors,
            'filters' => $filters,
        ]);
    }
    public function documentosSessoesPesquisar(Request $request)
    {

        $sessoes = $this->session->all();
        $tenants = $this->tenant->where('id', 3)->get();
        $tipos_sessao = $this->type_session->all();
        $legislaturas = $this->legislature->all();
        $tipos_documento = $this->type_document->all();


        $anexos_ordem_dia = $this->attachment_session
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
        return view('site.layouts.documentosSessoes', [
            'sessoes' => $sessoes,
            'tenants' =>  $tenants,
            'filters' => $filters,
            'tipos_sessao' => $tipos_sessao,
            'legislaturas' => $legislaturas,
            'anexos_ordem_dia' => $anexos_ordem_dia,
            'tipos_documento' => $tipos_documento,

        ]);
    }
    public function proposituraPesquisar(Request $request)
    {
        $tenants = $this->tenant->where('id', 3)->get();
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
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('site.layouts.proposituras', [
            'tenants' => $tenants,
            'tipos_propositura' => $tipos_propositura,
            'situacoes' => $situacoes,
            'tipos_documento' => $tipos_documento,
            'proposituras' => $proposituras,
            'filters' => $filters,
        ]);
    }
    public function proposituraShow($id)
    {

        $propositura =  $this->proposition->where('id', $id)->first();

        if (!$propositura)
            return redirect()->back();
        $tenants = $this->tenant->where('id', 3)->get();


        return view('site.layouts.proposituraShow', [
            'propositura' => $propositura,
            'tenants' =>  $tenants,
        ]);
    }
    public function parecerPesquisar(Request $request){
        
        $commissions = $this->commission->all();
        $tenants = $this->tenant->where('id', 3)->get(); 

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
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
          
        return view('site.layouts.pareceres',[
            'tenants' => $tenants,
            'seemCommissions'=> $seemCommissions,
            'commissions' => $commissions,
            'filters' => $filters,
        ]);
    }
    public function parecerShow($id){
        $tenants = $this->tenant->where('id', 3)->get(); 
        $seemCommission =  $this->seemCommission->where('id', $id)->first();

        if (!$seemCommission)
            return redirect()->back();
        $tenants = $this->tenant->where('id', 3)->get();


        return view('site.layouts.parecerShow', [
            'seemCommission' => $seemCommission,
            'tenants' =>  $tenants,
        ]);

    }
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
}
