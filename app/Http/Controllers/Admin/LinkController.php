<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpadateLink;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $repository;
    public function __construct(Link $repository){

        $this->repository = $repository;
    }
   
    public function index()
    {
        $links = $this->repository->paginate(10);
        $posicao = $this->repository::POSICAO;
        $tipo = $this->repository::TIPO;
        return view('admin.pages.links.index', compact('links', 'posicao', 'tipo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('novo-link');
        $links = $this->repository->get();
        return view('admin.pages.links.create', compact('links'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpadateLink $request)
    {
        $this->authorize('novo-link');
        $dadosLink = $request->all();
        $dadosLink['tenant_id'] = auth()->user()->tenant_id;
        //dd($dadosLink);
        if($request->icone){
            $dadosLink['icone'] = $request->icone->store('icones');
        } 
       
        $this->repository->create($dadosLink);

        toast('Cadastro realizado com sucesso!','success')->toToast('top');     
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
        $this->authorize('editar-link');
        $link = $this->repository->where('id', $id)->first();
        return view('admin.pages.links.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpadateLink $request, $id)
    {
        $this->authorize('editar-link');
        $link =  $this->repository->where('id', $id)->first();
        if(!$link){
            redirect()->back();
        }        
        $dadoslink = $request->all();
        if($request->hasFile('icone') && $request->icone->isValid()){
            if(Storage::exists($link->icone)){
               Storage::delete($link->icone);
            }           
            $dadoslink['icone'] = $request->icone->store('links');
        }      
        $link->update($dadoslink);

        toast('Link atualizado com sucesso!','success')->toToast('top') ;
        return redirect()->route('links.index'); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('excluir-link');
        $link = $this->repository->where('id', $id)->first();
        if(!$link){
            return redirect()->back();                      
        }  
        if($link->icone){
            if(Storage::exists($link->icone)){
                Storage::delete($link->icone);
            } 
        }
             
        $link->delete();
        toast('Link excluido com sucesso!','success')->toToast('top');            
        return redirect()->route('links.index');      
    }
}
