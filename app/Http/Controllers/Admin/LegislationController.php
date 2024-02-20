<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpadateLegislation;
use App\Models\AttachmentLegislation;
use App\Models\AttachmentSession;
use App\Models\Legislation;
use App\Models\TypeDocument;
use App\Models\TypeLegislation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LegislationController extends Controller
{
    private $repository, $type_legislation, $type_document;

    public function __construct(
        Legislation $legislation, 
        TypeLegislation $type_legislation,
        TypeDocument $type_document)
    {
        $this->repository = $legislation;
        $this->type_legislation = $type_legislation;
        $this->type_document = $type_document;
        
    }
    public function index()

    {
        $this->authorize('ver-legislacao');
        $legislations = $this->repository->orderBy('data', 'asc')->paginate(10);
        $type_legislations = $this->type_legislation->get();
        $type_documents = $this->type_document->get();

        return view('admin.pages.legislations.index', compact('legislations', 'type_legislations', 'type_documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('nova-legislacao');
        $type_legislations = $this->type_legislation->get();
        $type_documents = $this->type_document->get();     
         
        return view('admin.pages.legislations.create',[
            'type_legislations' => $type_legislations,
            'type_documents' => $type_documents,         
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpadateLegislation $request)
    {
        
        $this->authorize('nova-legislacao');
        $dadosLegislation = new Legislation();
        $dadosLegislation = $request->except('anexo', 'type_document_id');  
        $user = auth()->user();
        $dadosLegislation['user_id'] = $user->id;
        $dadosLegislation = $this->repository->create($dadosLegislation);

        //captura e percorre o array de anexo para fazer os registro e upload
        $anexo = $request->only('anexo', 'type_document_id');
        if ($request->hasFile('anexo')) {
            for ($i=0; $i < count($anexo['anexo']) ; $i++) { 
                $file = $anexo['anexo'][$i];
                $nome_original = Str::upper($anexo['anexo'][$i]->getClientOriginalName());
                $type_document = $request->type_document_id;
                $anexoLegislation = new AttachmentLegislation();
                $anexoLegislation->user_id = $user->id;
                $anexoLegislation->legislation_id = $dadosLegislation->id;
                $anexoLegislation->anexo = $file->store('attachments_legislations');
                $anexoLegislation->type_document_id =$type_document;
                $anexoLegislation->nome_original = $nome_original;
                $anexoLegislation->save();
                unset($anexoLegislation);
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
        $this->authorize('ver-legislacao');
        $legislation = $this->repository->where('id', $id)->first();

        if(!$legislation)
            return redirect()->back();

        return view('admin.pages.legislations.show',[
            'legislation' =>$legislation
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
        $this->authorize('editar-legislacao');
        $legislation = $this->repository->where('id', $id)->first();
        if (!$legislation) {
            return redirect()->back();
        }
        $type_legislations = $this->type_legislation->get();
        $type_documents = $this->type_document->get();  
        return view('admin.pages.legislations.edit',[
            'legislation' => $legislation,
            'type_legislations' => $type_legislations,
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
    public function update(Request $request, $id)
    {
        $this->authorize('editar-legislacao');
        $legislation = $this->repository->where('id', $id)->first();
        if (!$legislation) {
            return redirect()->back();
        }

        $dadosLegislation = $request->except('anexo', 'type_document_id');  
        $user = auth()->user();       
        $legislation->update($dadosLegislation);

        //Captura as seleção do select2 dos outores
        $request->only('councilors');        
        if($request->councilors){
            for ($i=0; $i < count($request->councilors); $i++) { 
                $councilorProposition[] =($request->councilors[$i]);
                $legislation->author()->sync($councilorProposition);
            }
        }
        //captura e percorre o array de anexo para fazer os registro e upload
        $anexo = $request->only('anexo', 'type_document_id');
        if ($request->hasFile('anexo')) {
            for ($i=0; $i < count($anexo['anexo']) ; $i++) { 
                $file = $anexo['anexo'][$i];
                $nome_original = Str::upper($anexo['anexo'][$i]->getClientOriginalName());
                $type_document = $request->type_document_id;
                $anexoLegislation = new AttachmentLegislation();
                $anexoLegislation->user_id = $user->id;
                $anexoLegislation->legislation_id = $legislation->id;
                $anexoLegislation->anexo = $file->store('attachments_legislations');
                $anexoLegislation->type_document_id =$type_document;
                $anexoLegislation->nome_original = $nome_original;
                $anexoLegislation->save();
                unset($anexoLegislation);
            }
        }
        toast('Cadastro atualizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('legislations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('excluir-legislacao');
        {
            //recupera o registro pelo id
            $legislation  = $this->repository->where('id', $id)->first();
            if(!$legislation){
                redirect()->back();
            }      
            for ($i=1; $i < count($legislation->attachments) ; $i++) { 
                 foreach ($legislation->attachments as $anexo) {
                  if(Storage::disk('s3')->exists($anexo->anexo)){
                      Storage::disk('s3')->delete($anexo->anexo);
                  }
                 }       
              }             
                           
            $legislation->delete();
            toast('Propositura excluida com sucesso!','success')->toToast('top');            
            return redirect()->route('legislations.index');    
      }
    }
    public function deleteAttachment($id)
    {
        $this->authorize('excluir-legislacao');
        //Recupera a anexo pelo id
        $anexo = AttachmentLegislation::where('id', $id)->first();
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
