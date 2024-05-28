<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateAttachmentSession;
use Illuminate\Support\Str;
use App\Http\Requests\StoreUpdateSession;
use App\Models\AttachmentSession;
use App\Models\Councilor;
use App\Models\Legislature;
use App\Models\LesgislatureCouncilors;
use App\Models\Period;
use App\Models\PresentCouncilorSessions;
use App\Models\Section;
use App\Models\Session;
use App\Models\TypeDocument;
use App\Models\TypeSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class SessionController extends Controller
{

    private $repository, $type_session, $legislature, 
            $legislature_session, $period,
            $type_document,
            $attachment_session,
            $councilor,
            $councilorLegislature;
            

    public function __construct(Session $session, 
     TypeSession $type_session,
     Legislature $legislature,
     Section $legislature_session,
     Period $period,
     TypeDocument $type_document,
     AttachmentSession $attachment_session,
     Councilor $councilor,
     LesgislatureCouncilors $councilorLegislature
     )
    {
        $this->repository = $session;
        $this->type_session = $type_session;
        $this->legislature = $legislature;
        $this->legislature_section = $legislature_session;
        $this->period = $period;
        $this->type_document = $type_document;
        $this->attachment_session = $attachment_session;
        $this->councilor = $councilor;
        $this->councilorLegislature = $councilorLegislature;
    }
    public function index(Request $request)
    {
        $this->authorize('ver-sessao');
        
        $types_session = $this->type_session->get();
        $periods = $this->period->get();
        
        $filters = $request->except('_token');
        $sessions = $this->repository
        ->when($request->type_session_id, function($query, $role) {
            return $query->where('type_session_id', $role);
        })  
        ->when($request->period_id, function($query, $role) {
            return $query->where('period_id', $role);
        })  
        ->when($request->ano, function($query, $role) {
            return $query->whereYear('data', $role);
        })
        ->when($request->ordenacao, function ($query, $role) {
            return $query->orderBy('nome', $role);
        })
        ->when($request->pesquisa, function($query, $role) {
            return $query->where('nome', 'LIKE', "%$role%");
        })           
        ->orderBy('created_at', 'DESC')->paginate(10);    
     
        return view('admin.pages.sessions.index', 
        compact('sessions', 'types_session', 'periods', 'filters'));



        //dd('chegou no index');
        // $sessions = $this->repository->orderBy('created_at', 'DESC')->paginate(10);       
        // $types_session = $this->type_session->get();
        // $periods = $this->period->get();
        // return view('admin.pages.sessions.index', compact('sessions', 'types_session', 'periods'));  
    }

    public function create()
    {
        $this->authorize('nova-sessao');
        $types_session = $this->type_session->get();
        $legislatures = $this->legislature->get();
        $sections = $this->legislature_section->get();
        $periods = $this->period->get();

        return view('admin.pages.sessions.create',[
            'types_session' => $types_session,
            'legislatures' => $legislatures,
            'sections' => $sections,
            'periods' => $periods,
           
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateSession $request)
    {
        $this->authorize('nova-sessao');
        $dados = $request->all();         
        $dados['user_id'] = auth()->user()->id;        
        $this->repository->create($dados);
        
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('ver-sessao');
        $session = $this->repository->where('id', $id)->first();
        $anexosSessao =$this->attachment_session->where('session_id', $id)->get(); 
        $councilors = $session->legislature->councilors;
        if(!$session){
            return redirect()->back();
        }

        
        return view('admin.pages.sessions.show',[
            'session' =>$session,
            'anexosSessao' =>$anexosSessao,
            'councilors' => $councilors,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('editar-sessao');
        $session = $this->repository->where('id', $id)->first();
        $types_session = $this->type_session->get();
        $legislatures = $this->legislature->get();
        $sections = $this->legislature_section->get();
        $periods = $this->period->get();


        //$anexosSessao =$this->attachment_session->where('session_id', $id)->get(); 

        if(!$session){
            return redirect()->back();                       
        }                       
        return view('admin.pages.sessions.edit',[
            'session' => $session,
            'types_session' => $types_session,
            'legislatures' => $legislatures,
            'sections' => $sections,
            'periods' => $periods,
            //'anexosSessao' => $anexosSessao,
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateSession $request, $id)
    {
        $this->authorize('editar-sessao');
        $session  = $this->repository->where('id', $id)->first();
        if(!$session){
            redirect()->back();
        }

       
        $session->update($request->all());
        toast('Sessão atualizada com sucesso!','success')->toToast('top') ;
        return redirect()->route('sessions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createAttachment ($id){
        $this->authorize('editar-sessao');
        $session = $this->repository->where('id', $id)->first();
        if(!$session){
            return redirect()->back();                       
        }   

        $type_documents = $this->type_document->get();
        // $functions = $this->function->get();
        
        return view('admin.pages.sessions.attachment.create', [            
            'session' => $session,
            'type_documents' =>$type_documents,
                     
        ]);  
    }

    public function storeAttachment (StoreUpdateAttachmentSession $request){
        $this->authorize('editar-sessao');
        $anexo= new AttachmentSession();

        $anexoSessao = $request->only('session_id', 'type_document_id', 'descricao', 'anexo');
        $anexoSessao['user_id'] = auth()->user()->id;
        //dd($anexoSessao);       
             
       if($request->hasFile('anexo')){
                $anexoSessao['nome_original'] = Str::upper($anexoSessao['anexo']->getClientOriginalName());
                $anexoSessao['anexo'] = $request->anexo->store('attachments_sessions');          
            }      
           $anexo->create($anexoSessao);  
           toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
           return redirect()->back();

    }

    public function deleteAttachment($id)
    {
        $this->authorize('excluir-sessao');
        //Recupera a anexo pelo id
        $anexo = AttachmentSession::where('id', $id)->first();
        //Verifica se pelo nome, se ela existe no storage, e deleta do storage
        if(Storage::disk('s3')->exists($anexo->anexo)){
            Storage::disk('s3')->delete($anexo->anexo);
        }
        //deleta a referência do banco
        $anexo->delete();  
        toast('Anexo  removido com sucesso!','success')->toToast('top') ;        
        return redirect()->back();
    }

    public function createPresentCouncilor($id){
        $this->authorize('nova-sessao');
        $session = $this->repository->where('id', $id)->first();
        if(!$session){
            return redirect()->back();                       
        } 
        //recupera os vereadores da lesgislatura
        $councilors = $session->legislature->councilors;
        
        return view('admin.pages.sessions.present.create', [            
            'session' => $session,           
            'councilors' => $councilors,
            
                     
        ]);  
    }
    public function storePresentCouncilor(Request $request, $id){      
       
        $this->authorize('nova-sessao');
        $presentSession = $this->repository->where('id', $id)->first();      
        $request->only('councilors'); 
        if($request->councilors){
           for ($i=0; $i < count($request->councilors) ; $i++) { 
               $councilorSession = ($request->councilors[$i]);
               $presentSession->councilors_present()->attach($councilorSession);       
   
           }
        }  
        toast('Presença lançada com sucesso!','success')->toToast('top') ;     
        return redirect()->route('sessions.index');
    }

    public function editPresentCouncilor(Request $request, $id){      
       
        $this->authorize('editar-sessao');
        $session = $this->repository->where('id', $id)->first();
        if(!$session){
            return redirect()->back();                       
        } 
        //recupera os vereadores da lesgislatura
        $councilors = $session->legislature->councilors;
        $edit =1;
        return view('admin.pages.sessions.present.edit', [            
            'session' => $session,           
            'councilors' => $councilors,
            'edit' => $edit,           
                     
        ]);
    }
        public function updatePresentCouncilor(Request $request, $id){
            $this->authorize('editar-sessao');
            $presentSession = $this->repository->where('id', $id)->first();      
            $request->only('councilors'); 
            if($request->councilors){
            for ($i=0; $i < count($request->councilors) ; $i++) { 
                $councilorSession[] = ($request->councilors[$i]);
                $presentSession->councilors_present()->sync($councilorSession);      
    
            }
            }  
        toast('Presença Atualizada com sucesso!','success')->toToast('top') ;     
        return redirect()->route('sessions.index');
            
        }


    //     public function search(Request $request){
               
    //         $types_session = $this->type_session->get();
    //         $periods = $this->period->get();
            
    //         $filters = $request->except('_token');
    //         $sessions = $this->repository
    //         ->when($request->type_session_id, function($query, $role) {
    //             return $query->where('type_session_id', $role);
    //         })  
    //         ->when($request->period_id, function($query, $role) {
    //             return $query->where('period_id', $role);
    //         })  
    //         ->when($request->ano, function($query, $role) {
    //             return $query->whereYear('data', $role);
    //         })
    //         ->when($request->ordenacao, function ($query, $role) {
    //             return $query->orderBy('nome', $role);
    //         })
    //         ->when($request->pesquisa, function($query, $role) {
    //             return $query->where('nome', 'LIKE', "%$role%");
    //         })           
    //         ->orderBy('created_at', 'DESC')->paginate(10);    
         
    //         return view('admin.pages.sessions.index', 
    //         compact('sessions', 'types_session', 'periods', 'filters'));
    //    }

        
}
