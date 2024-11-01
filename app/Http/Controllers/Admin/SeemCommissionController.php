<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSeemCommission;
use App\Models\AttachmentSeemCommission;
use App\Models\Commission;
use App\Models\Proposition;
use App\Models\SeemCommission;
use App\Models\TypeDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SeemCommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $repository, $proposition, $type_document, $commission;

    public function __construct(
        SeemCommission $seemCommission, 
        Proposition $proposition,
        TypeDocument $type_document,
        Commission $commission,
        )
    {
        $this->repository = $seemCommission;
        $this->proposition = $proposition;
        $this->type_document = $type_document;
        $this->commission = $commission;
        
    }
    public function index(Request $request)
    {   
        $this->authorize('ver-parecer');
        $commissions =  $this->commission::get();
        //$seemCommissions = $this->repository->orderBy('created_at', 'DESC')->paginate(10);
        $filters = $request->except('_token');
       
        //dd($request->comission_id);
        $seemCommissions = $this->repository            
        ->when($request->commission_id, function ($query, $role) {
            return $query->where('commission_id', $role);
        })
        ->when($request->ano, function ($query, $role) {
            return $query->whereYear('data', $role);
        })
        ->when($request->pesquisa, function($query, $role) {
            return $query->where('descricao', 'LIKE', "%$role%")
                        ->orWhere('assunto', 'LIKE', "%$role%");
        })
        ->when($request->ordenacao, function ($query, $role) {
            return $query->orderBy('data', $role);
        })
        //->orderBy('numero', 'ASC')
        ->orderBy('created_at', 'DESC')
        ->paginate(10);



        return view('admin.pages.seemCommissions.index', compact('seemCommissions', 'commissions','filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('novo-parecer');
        $type_documents = $this->type_document->where('propositura', 1)->get();
        $propositions =$this->proposition->get();
        $commissions =  $this->commission->get();   
       // dd($commissions);     

        return view('admin.pages.seemCommissions.create',[
            'type_documents' => $type_documents,
            'propositions' => $propositions, 
            'commissions' => $commissions,                          
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateSeemCommission $request)
    {
        $this->authorize('novo-parecer');          
        $dadosSeemCommission= new SeemCommission();
        $dadosSeemCommission = $request->except('anexo', 'type_document_id');  
        $user = auth()->user();
        $dadosSeemCommission['user_id'] = $user->id;
        //dd($dadosSeemCommission);
        $dadosSeemCommission = $this->repository->create($dadosSeemCommission);

        //captura e percorre o array de anexo para fazer os registro e upload
        $anexo = $request->only('anexo', 'type_document_id');
        if ($request->hasFile('anexo')) {
            for ($i=0; $i < count($anexo['anexo']) ; $i++) { 
                $file = $anexo['anexo'][$i];
                $nome_original = Str::upper($anexo['anexo'][$i]->getClientOriginalName());
                $type_document = $request->type_document_id;
                $anexoSeeCommission = new AttachmentSeemCommission();
                $anexoSeeCommission->user_id = $user->id;
                $anexoSeeCommission->seem_commission_id = $dadosSeemCommission->id;
                $anexoSeeCommission->anexo = $file->store('attachments_SeemCommission');
                $anexoSeeCommission->type_document_id =$type_document;
                $anexoSeeCommission->nome_original = $nome_original;
                $anexoSeeCommission->save();
                unset($anexoSeeCommission);
            }
        }
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('seemCommissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('ver-parecer');
        $seemCommission = $this->repository->where('id', $id)->first();

        if(!$seemCommission)
            return redirect()->back();

        return view('admin.pages.seemCommissions.show',[
            'seemCommission' =>$seemCommission
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
        $this->authorize('editar-parecer');

        $seemCommission = $this->repository->where('id', $id)->first();
        if (!$seemCommission) {
            return redirect()->back();
        }
        $type_documents = $this->type_document->where('propositura', 1)->get();
        $propositions =$this->proposition->get();
        $commissions =  $this->commission->get();       
        return view('admin.pages.seemCommissions.edit',[
            'seemCommission' => $seemCommission,
            'propositions' => $propositions,
            'commissions' => $commissions,
            'type_documents' => $type_documents,            
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateSeemCommission $request, $id)
    {
        $this->authorize('editar-parecer');
        $seemCommission = $this->repository->where('id', $id)->first();
        if (!$seemCommission) {
            return redirect()->back();
        }

        $dadosSeemCommission = $request->except('anexo', 'type_document_id');  
        $user = auth()->user();       
        $seemCommission->update($dadosSeemCommission);
        //captura e percorre o array de anexo para fazer os registro e upload
        $anexo = $request->only('anexo', 'type_document_id');
        if ($request->hasFile('anexo')) {
            for ($i=0; $i < count($anexo['anexo']) ; $i++) { 
                $file = $anexo['anexo'][$i];
                $nome_original = Str::upper($anexo['anexo'][$i]->getClientOriginalName());
                $type_document = $request->type_document_id;
                $anexoSeeCommission = new AttachmentSeemCommission();
                $anexoSeeCommission->user_id = $user->id;
                $anexoSeeCommission->seem_commission_id = $seemCommission->id;
                $anexoSeeCommission->anexo = $file->store('attachments_SeemCommission');
                $anexoSeeCommission->type_document_id =$type_document;
                $anexoSeeCommission->nome_original = $nome_original;
                $anexoSeeCommission->save();
                unset($anexoSeeCommission);
            }
        }
        toast('Cadastro atualizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('seemCommissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('excluir-parecer');
        //recupera o registro pelo id
        $seemCommission  = $this->repository->where('id', $id)->first();
        if(!$seemCommission){
            redirect()->back();
        }      
        for ($i=1; $i < count($seemCommission->attachments) ; $i++) { 
             foreach ($seemCommission->attachments as $anexo) {
              if(Storage::disk('s3')->exists($anexo->anexo)){
                  Storage::disk('s3')->delete($anexo->anexo);
              }
             }         

        }                    
          
          
        $seemCommission->delete();
        toast('Parecer excluido com sucesso!','success')->toToast('top');            
        return redirect()->route('seemCommissions.index'); 
    }
    public function deleteAttachment($id)
    {
        $this->authorize('excluir-parecer');
        //Recupera a anexo pelo id
        $anexo = AttachmentSeemCommission::where('id', $id)->first();
        //Verifica se pelo nome, se ela existe no storage, e deleta do storage
        if(Storage::disk('s3')->exists($anexo->anexo)){
            Storage::disk('s3')->delete($anexo->anexo);
        }
        //deleta a referência do banco
        $anexo->delete();  
        toast('Anexo  removido com sucesso!','success')->toToast('top') ;        
        return redirect()->back();
    }
}
