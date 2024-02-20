<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProposition;
use App\Models\AttachmentProposition;
use Illuminate\Support\Str;
use App\Models\Councilor;
use App\Models\ProceedingSituation;
use App\Models\Proposition;
use App\Models\TypeDocument;
use App\Models\TypeProposition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPSTORM_META\type;

class PropositionController extends Controller
{
    private 
        $repository,
        $type_proposition,
        $type_document,
        $situation,
        $councilor,
        $proceeding_situation;

    public function __construct(
        Proposition $proposition,
        TypeProposition $type_proposition,
        TypeDocument $type_document,
        ProceedingSituation $situation,
        Councilor $councilor,
        ProceedingSituation $proceeding_situation
     )
    {
        $this->repository = $proposition;
        $this->type_proposition = $type_proposition;
        $this->type_document = $type_document;
        $this->situation = $situation;
        $this->councilor = $councilor;
        $this->proceeding_situation = $proceeding_situation;
        
    }
    
    public function index(Request $request)
    {
        $this->authorize('ver-propositura');
        
        $councilors = $this->councilor->all();
        $situacoes = $this->proceeding_situation->all();
        $filters = $request->except('_token');
       
        $propositions = $this->repository            
            ->when($request->proceeding_situation_id, function ($query, $role) {
                return $query->where('proceeding_situation_id', $role);
            })
            ->when($request->ano, function ($query, $role) {
                return $query->whereYear('data', $role);
            })
            ->when($request->pesquisa, function($query, $role) {
                return $query->where('descricao', 'LIKE', "%$role%");
            })
            ->when($request->ordenacao, function ($query, $role) {
                return $query->orderBy('numero', $role);
            })
            //->orderBy('numero', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        
        return view('admin.pages.propositions.index', compact('propositions', 'councilors', 'situacoes', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('nova-propositura');
        $type_propositions = $this->type_proposition->get();
        $type_documents = $this->type_document->get();
        $situations = $this->situation->get();  
        $councilors = $this->councilor->all();   

        return view('admin.pages.propositions.create',[
            'type_propositions' => $type_propositions,
            'type_documents' => $type_documents,
            'situations' => $situations,
            'councilors' => $councilors,
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProposition $request)
    {

        $this->authorize('nova-propositura');
        $dadosProposition = new Proposition();
        $dadosProposition = $request->except('councilors', 'anexo', 'type_document_id');  
        $user = auth()->user();
        $dadosProposition['user_id'] = $user->id;
        $dadosProposition = $this->repository->create($dadosProposition);

        //Captura as seleção do select2 dos outores
        $request->only('councilors');
        if($request->councilors){
            for ($i=0; $i < count($request->councilors); $i++) { 
                $councilorProposition =($request->councilors[$i]);
                $dadosProposition->author()->attach($councilorProposition);
            }
        }
        //captura e percorre o array de anexo para fazer os registro e upload
        $anexo = $request->only('anexo', 'type_document_id');
        if ($request->hasFile('anexo')) {
            for ($i=0; $i < count($anexo['anexo']) ; $i++) { 
                $file = $anexo['anexo'][$i];
                $nome_original = Str::upper($anexo['anexo'][$i]->getClientOriginalName());
                $type_document = $request->type_document_id;
                $anexoProposition = new AttachmentProposition();
                $anexoProposition->user_id = $user->id;
                $anexoProposition->proposition_id = $dadosProposition->id;
                $anexoProposition->anexo = $file->store('attachments_propositions');
                $anexoProposition->type_document_id =$type_document;
                $anexoProposition->nome_original = $nome_original;
                $anexoProposition->save();
                unset($anexoProposition);
            }
        }
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('editar-propositura');
        $proposition = $this->repository->where('id', $id)->first();
        if (!$proposition) {
            return redirect()->back();
        }
        $type_propositions = $this->type_proposition->get();
        $type_documents = $this->type_document->get();
        $situations = $this->situation->get();  
        $councilors = $this->councilor->all();
        
        //dd($proposition);
        return view('admin.pages.propositions.edit',[
            'proposition' => $proposition,
            'type_propositions' => $type_propositions,
            'type_documents' => $type_documents,
            'situations' => $situations,
            'councilors' => $councilors,
            
        ]);

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProposition $request, $id)
    {
        $this->authorize('editar-propositura');
        $proposition = $this->repository->where('id', $id)->first();
        if (!$proposition) {
            return redirect()->back();
        }

        $dadosProposition = $request->except('councilors', 'anexo', 'type_document_id');  
        $user = auth()->user();
        $dadosProposition['user_id'] = $user->id;
        $proposition->update($dadosProposition);

        //Captura as seleção do select2 dos outores
        $request->only('councilors');        
        if($request->councilors){
            for ($i=0; $i < count($request->councilors); $i++) { 
                $councilorProposition[] =($request->councilors[$i]);
                $proposition->author()->sync($councilorProposition);
            }
        }
        //captura e percorre o array de anexo para fazer os registro e upload
        $anexo = $request->only('anexo', 'type_document_id');
        if ($request->hasFile('anexo')) {
            for ($i=0; $i < count($anexo['anexo']) ; $i++) { 
                $file = $anexo['anexo'][$i];
                $nome_original = Str::upper($anexo['anexo'][$i]->getClientOriginalName());
                $type_document = $request->type_document_id;
                $anexoProposition = new AttachmentProposition();
                $anexoProposition->user_id = $user->id;
                $anexoProposition->proposition_id = $proposition->id;
                $anexoProposition->anexo = $file->store('attachments_propositions');
                $anexoProposition->type_document_id =$type_document;
                $anexoProposition->nome_original = $nome_original;
                $anexoProposition->save();
                unset($anexoProposition);
            }
        }
        toast('Cadastro atualizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('propositions.index');




    }

    /**code 
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('excluir-propositura');
          //recupera o registro pelo id
          $proposition  = $this->repository->where('id', $id)->first();
          if(!$proposition){
              redirect()->back();
          }      
          for ($i=1; $i < count($proposition->attachments) ; $i++) { 
               foreach ($proposition->attachments as $anexo) {
                if(Storage::disk('s3')->exists($anexo->anexo)){
                    Storage::disk('s3')->delete($anexo->anexo);
                }
               }         

          }                    
            
            
          $proposition->delete();
          toast('Propositura excluida com sucesso!','success')->toToast('top');            
          return redirect()->route('propositions.index');    
    }

    public function deleteAttachment($id)
    {
        $this->authorize('excluir-propositura');
        //Recupera a anexo pelo id
        $anexo = AttachmentProposition::where('id', $id)->first();
        //Verifica se pelo nome, se ela existe o storage, e deleta do storage
        if(Storage::disk('s3')->exists($anexo->anexo)){
            Storage::disk('s3')->delete($anexo->anexo);
        }
        //deleta a referência do banco
        $anexo->delete();  
        toast('Anexo  removido com sucesso!','success')->toToast('top') ;        
        return redirect()->back();
    }
}
