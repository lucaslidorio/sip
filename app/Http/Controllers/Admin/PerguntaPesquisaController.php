<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerguntasPesquisa;
use App\Models\Questionario;
use Illuminate\Http\Request;

class PerguntaPesquisaController extends Controller
{
   
    public function index()
{
    $this->authorize('ver-pesquisa');
    // Busca os questionários com paginação
    $pesquisas = Questionario::orderBy('created_at', 'desc')->paginate(10);

    // Retorna a view com os dados
    return view('admin.pages.pesquisas.index', compact('pesquisas'));
}   


    public function perguntas($questionarioId)
    {
    
        $this->authorize('ver-pesquisa');
        // Carrega o questionário para exibir na view, se necessário
        $questionario = Questionario::findOrFail($questionarioId);

        // Filtra apenas perguntas vinculadas ao questionário selecionado
        $perguntas = PerguntasPesquisa::with('questionario')
                        ->where('questionario_id', $questionarioId)
                        ->latest()
                        ->paginate(10);

        return view('admin.pages.pesquisas.perguntas', compact('perguntas', 'questionario'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($questionario_id)
    {
        $this->authorize('nova-pesquisa');
        
        return view('admin.pages.pesquisas.create', compact('questionario_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
