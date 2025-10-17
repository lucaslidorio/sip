<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePopups;
use App\Models\Popups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PopupsController extends Controller
{
    private $popup;

    public function __construct(Popups $popup)
    {
        $this->popup = $popup;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('ver-post');
        $popups = $this->popup->orderby('created_at', 'desc')->paginate(10);
        return view('admin.pages.popups.index', compact('popups'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('novo-post');
        return view('admin.pages.popups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdatePopups $request)
    {
        $this->authorize('novo-post');

        $dadosPopup = $request->all();
        
        if($request->hasFile('img') && $request->img->isValid()){
            $dadosPopup['img'] = $request->img->store('popups');
        } 
        $this->popup->create($dadosPopup);

        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('editar-post');
        $popup = $this->popup->where('id', $id)->first();
        return view('admin.pages.popups.edit', compact('popup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdatePopups $request, string $id)
    {
        $this->authorize('editar-post');
        $popup =  $this->popup->where('id', $id)->first();
        if(!$popup){
            redirect()->back();
        }        
        $dadosPopup = $request->all();
        if($request->hasFile('img') && $request->img->isValid()){
            if(Storage::exists($popup->img)){
               Storage::delete($popup->img);
            }           
            $dadosPopup['img'] = $request->img->store('popups');
        }      
        $popup->update($dadosPopup);
        toast('Popup atualizado com sucesso!','success')->toToast('top') ;
        return redirect()->route('popups.index'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('novo-post');
        $popup = $this->popup->where('id', $id)->first();
        if(!$popup){
            return redirect()->back();                      
        }       
        $popup->delete();
        toast('Popup excluido com sucesso!','success')->toToast('top');            
        return redirect()->route('popups.index');
    }

    public function search (Request $request){

        $this->authorize('ver-post');
        $pesquisar = $request->except('_token');
        $popups = $this->popup->search($request->pesquisa);

        return view('admin.pages.popups.index', [
            'popups' =>$popups,
            'pesquisar' =>$pesquisar
        ]);
    }
}
