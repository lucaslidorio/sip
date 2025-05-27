<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerguntasPesquisa;
use App\Models\Questionario;
use Illuminate\Http\Request;

class PerguntaPesquisaController extends Controller
{
   
    // public function pesquisas()
    // {
    //         $this->authorize('ver-pesquisa');
    //         $pesquisas = Questionario::paginate(10);
    //         return view('admin.pages.pesquisas.index', compact('pesquisas'));       
    // }    

    public function index()
    {
        $perguntas = PerguntasPesquisa::with('questionario')->latest()->paginate(10);
        return view('admin.pages.perguntas.index', compact('perguntas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
