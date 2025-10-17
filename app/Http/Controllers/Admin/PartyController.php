<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateParty;
use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Config;
class PartyController extends Controller
{
    private $party;

    public function __construct(Party $party)
    {
        $this->party = $party;
        
    }
    public function index()
    {
        $this->authorize('ver-partido');
        $parties = $this->party->paginate(10);
        return view('admin.pages.parties.index', compact('parties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('novo-partido');
        return view('admin.pages.parties.create');
    }

    public function store(StoreUpdateParty $request)
    {
        $this->authorize('novo-partido');
        $dadosParty = $request->all();        
        if($request->hasFile('img') && $request->img->isValid()){
            $dadosParty['img'] = $request->img->store('parties');
        } 
        $this->party->create($dadosParty);

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
        $this->authorize('editar-partido');
        $party = $this->party->where('id', $id)->first();
        return view('admin.pages.parties.edit', compact('party'));

    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateParty $request, $id)
    {
        $this->authorize('editar-partido');
        $party =  $this->party->where('id', $id)->first();
        if(!$party){
            redirect()->back();
        }        
        $dadosParty = $request->all();
        if($request->hasFile('img') && $request->img->isValid()){
            if(Storage::exists($party->img)){
               Storage::delete($party->img);
            }           
            $dadosParty['img'] = $request->img->store('parties');
        }      
        $party->update($dadosParty);
        toast('Partido atualizado com sucesso!','success')->toToast('top') ;
        return redirect()->route('parties.index'); 
    
    }

   
    public function destroy($id)
    {
        $this->authorize('novo-partido');
        $party = $this->party->where('id', $id)->first();
        if(!$party){
            return redirect()->back();                      
        }       
        $party->delete();
        toast('Partido excluido com sucesso!','success')->toToast('top');            
        return redirect()->route('parties.index');
    }

    public function search (Request $request){

        $this->authorize('ver-partido');
        $pesquisar = $request->except('_token');
        $parties = $this->party->search($request->pesquisa);

        return view('admin.pages.parties.index', [
            'parties' =>$parties,
            'pesquisar' =>$pesquisar
        ]);
    }
}
