<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSubTipoMateria;
use App\Models\SubTipoMateria;
use App\Models\TipoMateria;
use Illuminate\Http\Request;

class SubTipoMateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $repository, $tiposMaterias;
    public function __construct(SubTipoMateria $subTipoMateria, TipoMateria $tiposMaterias)
    {
        $this->repository = $subTipoMateria;
        $this->tiposMaterias = $tiposMaterias;        
    }
    public function index(Request $request)
    {
        $this->authorize('ver-subtipo-materia');
        // Captura o termo de pesquisa, se fornecido
        $pesquisar = $request->input('pesquisa');
        $subTipoMaterias = $this->repository
        ->when($pesquisar, function ($query, $pesquisar) {
            return $query->where('nome', 'like', '%' . $pesquisar . '%');
        })
        ->paginate(10);
        return view('admin.pages.subTipoMaterias.index',compact( 'subTipoMaterias', 'pesquisar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('novo-subtipo-materia');
        $tiposMaterias = $this->tiposMaterias->get();
        return view('admin.pages.subTipoMaterias.create', compact('tiposMaterias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateSubTipoMateria $request)
    {
        $this->authorize('novo-subtipo-materia');

        $this->repository->create($request->all());
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('subTipoMaterias.index');
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
        $this->authorize('editar-subtipo-materia');
        $subTipoMateria = $this->repository->where('id', $id)->first(); 
        $tiposMaterias = $this->tiposMaterias->get();     
        if(!$subTipoMateria){
            return redirect()->back();                       
        }                       
        return view('admin.pages.subTipoMaterias.edit', compact('subTipoMateria','tiposMaterias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateSubTipoMateria $request, string $id)
    {
        $this->authorize('editar-subtipo-materia');
        $subTipoMateria = $this->repository->where('id', $id)->first();
        if(!$subTipoMateria){
            return redirect()->back();                       
        }

        $subTipoMateria->update($request->all());
        toast('SubTipo de matéria atualizado com sucesso!','success')->toToast('top') ; 
        return redirect()->route('subTipoMaterias.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('excluir-subtipo-materia');
        $subTipoMateria = $this->repository->where('id', $id)->first();

        if(!$subTipoMateria){
            return redirect()->back();
                       
        }       
        $subTipoMateria->delete();
        toast('Tipo de matéria excluido com sucesso!','success')->toToast('top');            
        return redirect()->route('subTipoMaterias.index');
    }
    }

