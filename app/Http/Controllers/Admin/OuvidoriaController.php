<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ouvidoria;
use App\Models\RespostaOuvidoria;
use Illuminate\Http\Request;

class OuvidoriaController extends Controller
{
    private $repository, $resposta;
    public function __construct(Ouvidoria $repository, RespostaOuvidoria $resposta){
        $this->repository = $repository;
        $this->resposta = $resposta;

     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ouvidorias = $this->repository->paginate(10);   
        return view('admin.pages.ouvidorias.index', compact('ouvidorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ouvidoria= $this->repository->findOrFail($id);
        $ocupacao = $this->repository::OCUPACAO; 

       
        return view('admin.pages.ouvidorias.show', compact('ouvidoria','ocupacao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ouvidoria= $this->repository->findOrFail($id);
        $ocupacao = $this->repository::OCUPACAO; 
        return view('admin.pages.ouvidorias.edit', compact('ouvidoria','ocupacao'));
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
        $ouvidoria = $this->repository->findOrFail($id);

        $user = auth()->user();
        $dadosRequest = $request->all();
        $dadosRequest['user_id'] = $user->id;
        $dadosRequest['ouvidoria_id'] = $ouvidoria->id;        
     
        $this->resposta->create($dadosRequest);         

        toast('Ouvidoria respondida com sucesso!','success')->toToast('top') ;     
        return redirect()->route('ouvidorias.index');

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
}
