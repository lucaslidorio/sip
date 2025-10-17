<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConfiguracaoOuvidoria;
use Illuminate\Http\Request;

class ConfiguracaoOuvidoriaController extends Controller
{
    private $configuracao;
    
    public function __construct(ConfiguracaoOuvidoria $configuracao)
    {
        $this->configuracao = $configuracao;
        
    }
    public function index()
    {
        $this->authorize('ver-ouvidoria');
        $configuracoes = $this->configuracao->paginate(10);
        return view('admin.pages.configuracaoOuvidoria.index', compact('configuracoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('novo-ouvidoria');
        return view('admin.pages.configuracaoOuvidoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('novo-ouvidoria');              
        
        $this->configuracao->create($request->all());

        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('ouvidoria.configuracao.index');
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
        $this->authorize('editar-ouvidoria');
        $configuracao = $this->configuracao->find($id);
        if(!$configuracao){
            redirect()->back();
        }
        return view('admin.pages.configuracaoOuvidoria.edit' ,compact('configuracao')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('editar-ouvidoria');
        if($configuracao = $this->configuracao->find($id)){
            redirect()->back();
        }
        $configuracao->update($request->all());
        toast('Dados atualizados com sucesso!','success')->toToast('top') ;
        return redirect()->route('ouvidoria.configuracao.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
