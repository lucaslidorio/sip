<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttachmentPage;
use App\Models\Page;
use App\Models\TypeDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PagesController extends Controller
{

    private $repository, $type_document;

    public function __construct(Page $repository, TypeDocument $type_document)
    {
        $this->repository = $repository;
        $this->type_document = $type_document;
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $pages = $this->repository->paginate(10);
        return view('admin.pages.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = $this->repository->get();
        $type_documents = $this->type_document->get();  
        return view('admin.pages.pages.create', compact('pages', 'type_documents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {          
        
        $dadosPage = new Page();
        $dadosPage = $request->except('anexo', 'type_document_id');  
        $user = auth()->user();
        $dadosPage['tenant_id'] = $user->tenant_id;
        $dadosPage['slug'] = Str::of($request->titulo)->kebab();     
        $dadosPage = $this->repository->create($dadosPage);

        //captura e percorre o array de anexo para fazer os registro e upload
        $anexo = $request->only('anexo', 'type_document_id');
        if ($request->hasFile('anexo')) {
            for ($i=0; $i < count($anexo['anexo']) ; $i++) { 
                $file = $anexo['anexo'][$i];
                $nome_original = Str::upper($anexo['anexo'][$i]->getClientOriginalName());
                $type_document = $request->type_document_id;
                $anexoPage = new AttachmentPage();               
                $anexoPage->page_id = $dadosPage->id;
                $anexoPage->anexo = $file->store('attachments_pages');
                $anexoPage->type_document_id =$type_document;
                $anexoPage->nome_original = $nome_original;
                $anexoPage->save();
                unset($anexoPage);
            }
        }
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function show(c $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page  = $this->repository->where('id', $id)->first();
        $type_documents = $this->type_document->get();             
        if(!$page){
            return redirect()->back();                       
        }                       
        return view('admin.pages.pages.edit',compact('page', 'type_documents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $page = $this->repository->where('id', $id)->first();
        if (!$page) {
            return redirect()->back();
        }

        $dadosPage = $request->except('anexo', 'type_document_id');  
        $user = auth()->user();
        $dadosPage['slug'] = Str::of($request->titulo)->kebab();         
        $page->update($dadosPage);
      
        //captura e percorre o array de anexo para fazer os registro e upload
        $anexo = $request->only('anexo', 'type_document_id');
        if ($request->hasFile('anexo')) {
            for ($i=0; $i < count($anexo['anexo']) ; $i++) { 
                $file = $anexo['anexo'][$i];
                $nome_original = Str::upper($anexo['anexo'][$i]->getClientOriginalName());
                $type_document = $request->type_document_id;
                $anexoPage = new AttachmentPage();
                //$anexoPage->user_id = $user->id;
                $anexoPage->page_id = $page->id;
                $anexoPage->anexo = $file->store('attachments_pages');
                $anexoPage->type_document_id =$type_document;
                $anexoPage->nome_original = $nome_original;
                $anexoPage->save();
                unset($anexoPage);
            }
        }
        toast('Cadastro atualizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //recupera o registro pelo id
        $page  = $this->repository->where('id', $id)->first();
        if(!$page){
            redirect()->back();
        }      
        for ($i=1; $i < count($page->attachments) ; $i++) { 
             foreach ($page->attachments as $anexo) {
              if(Storage::disk('s3')->exists($anexo->anexo)){
                  Storage::disk('s3')->delete($anexo->anexo);
              }
             }       
          }             
                       
        $page->delete();
        toast('Página excluida com sucesso!','success')->toToast('top');            
        return redirect()->route('pages.index'); 
    }
    public function deleteAttachment($id)
    {
        //Recupera a anexo pelo id
        $anexo = AttachmentPage::where('id', $id)->first();
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
