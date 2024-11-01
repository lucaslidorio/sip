<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTipoMateria;
use App\Models\TipoMateria;
use Illuminate\Http\Request;

class TipoMateriaController extends Controller
{
    private $repository;
    public function __construct(TipoMateria $tipoMateria)
    {
     
        $this->repository = $tipoMateria;
    }
    public function index(Request $request)
    {
        $this->authorize('ver-tipo-materia');
        $pesquisar = $request->input('pesquisa');     
       
        // Busca as enquetes com base na pesquisa, se houver
        $tipoMaterias = $this->repository
            ->when($pesquisar, function ($query, $pesquisar) {
                return $query->where('nome', 'like', '%' .$pesquisar. '%');
            })
            ->paginate(10);    

        return view('admin.pages.tipoMaterias.index', compact('tipoMaterias', 'pesquisar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('novo-tipo-materia');
        return view('admin.pages.tipoMaterias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateTipoMateria $request)
    {
        $this->authorize('novo-tipo-materia');
        $this->repository->create($request->all());
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('tipoMaterias.index');
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
        $this->authorize('editar-tipo-materia');
        $tipoMateria = $this->repository->where('id', $id)->first();       
        if(!$tipoMateria){
            return redirect()->back();                       
        }                       
        return view('admin.pages.tipoMaterias.edit',[
            'tipoMateria' => $tipoMateria,           
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateTipoMateria $request, string $id)
    {
        $this->authorize('editar-tipo-materia');
        $tipoMateria = $this->repository->where('id', $id)->first();
        if(!$tipoMateria){
            return redirect()->back();                       
        }

        $tipoMateria->update($request->all());
        toast('Tipo de matéria atualizado com sucesso!','success')->toToast('top') ; 
        return redirect()->route('tipoMaterias.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('excluir-tipo-materia');
        $tipoMateria = $this->repository->where('id', $id)->first();

        if(!$tipoMateria){
            return redirect()->back();                       
        }       
        $tipoMateria->delete();
        toast('Tipo de matéria excluido com sucesso!','success')->toToast('top');            
        return redirect()->route('tipoMaterias.index');
    }
}
