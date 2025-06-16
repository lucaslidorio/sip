<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePronunciamento;
use App\Models\Councilor;
use App\Models\Legislature;
use App\Models\Pronunciamento;
use App\Models\Session;
use Illuminate\Http\Request;

class PronunciamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('ver-pronunciamento');

        $query = Pronunciamento::with(['councilor', 'session.legislature']);
    
        // Filtro por legislatura
        if ($request->filled('legislatura_id')) {
            $query->whereHas('session.legislature', function ($q) use ($request) {
                $q->where('id', $request->legislatura_id);
            });
        }    
        // Filtro por sessão
        if ($request->filled('session_id')) {
            $query->where('session_id', $request->session_id);
        }    
        // Filtro por nome do vereador (campo 'pesquisa')
        if ($request->filled('pesquisa')) {
            $query->whereHas('councilor', function ($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->pesquisa . '%');
            });
        }   
        // Filtro por ano da sessão
        if ($request->filled('ano')) {
            $query->whereHas('session', function ($q) use ($request) {
                $q->whereYear('data', $request->ano); // considerando que a tabela `sessions` tenha uma coluna `data`
            });
        }    
        $pronunciamentos = $query->latest()->paginate(10);
        $legislaturas = Legislature::orderBy('ordem', 'asc')->get();
        $sessoes = Session::orderBy('data', 'desc')->get();
    
        return view('admin.pages.pronunciamentos.index', compact('pronunciamentos', 'legislaturas', 'sessoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('novo-pronunciamento');
      
        $councilors = Councilor::orderBy('nome', 'asc')->where('atual', 1)->get();
        $legislaturas = Legislature::orderBy('ordem', 'asc')->get();
        $sessoes = Session::orderBy('data', 'desc')->get();
        return view('admin.pages.pronunciamentos.create', compact('legislaturas', 'sessoes', 'councilors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdatePronunciamento $request)
    {
        $this->authorize('criar-pronunciamento');  

        Pronunciamento::create($request->validated());


        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('pronunciamentos.index');        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('ver-pronunciamento');

        $pronunciamento = Pronunciamento::with(['    public function councilor()
', 'session'])->findOrFail($id);
    
        return view('admin.pages.pronunciamentos.show', compact('pronunciamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('editar-pronunciamento');
    
        $pronunciamento = Pronunciamento::with(['councilor', 'session'])->findOrFail($id);      
                        
        // Dados para os selects
        $councilors = Councilor::orderBy('nome')->where('atual', 1)->get();
        $sessoes = Session::orderBy('data', 'desc')->get();
    
        return view('admin.pages.pronunciamentos.edit', compact('pronunciamento', 'councilors', 'sessoes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdatePronunciamento $request, $id)
    {
        
        $this->authorize('editar-pronunciamento');
    
        $pronunciamento = Pronunciamento::findOrFail($id); 
        $pronunciamento->update($request->validated());
    
        toast('Registro atualizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('pronunciamentos.index'); 

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('excluir-pronunciamento');
        $pronunciamento = Pronunciamento::findOrfail($id);
        $pronunciamento->delete();
        toast('Pronunciamento excluido com sucesso!','success')->toToast('top');            
        return redirect()->route('pronunciamentos.index');
    }
}
