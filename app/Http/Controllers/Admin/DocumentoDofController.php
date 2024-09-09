<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentosDof;
use App\Models\SubTipoMateria;
use App\Models\TipoMateria;
use Illuminate\Http\Request;

class DocumentoDofController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $repository, $subTipoMateria, $tipoMateria;
    public function __construct(DocumentosDof $repository, SubTipoMateria $subTipoMateria, TipoMateria $tipoMateria){
        $this->repository = $repository;
        $this->tipoMateria = $tipoMateria;
        $this->subTipoMateria = $subTipoMateria;
    }

    public function index()
    {       
        $this->authorize('ver-documento-dof');
        $documentos = $this->repository->paginate(15);      

        return view('admin.pages.documentosDof.index', compact('documentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('novo-documento-dof');
        $tiposMateria = $this->tipoMateria->get();
        $subTiposMateria = $this->subTipoMateria->get();
        return view('admin.pages.documentosDof.create',compact('subTiposMateria','tiposMateria'));

    }

    public function getSubTiposByTipo($tipo_materia_id)
    {
        // Busca os subtipos relacionados ao tipo de matéria
        $subTipos = $this->subTipoMateria->where('tipo_materia_id', $tipo_materia_id)->get();        
        // Retorna a resposta em formato JSON
        return response()->json($subTipos);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $this->authorize('novo-documento-dof');
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['user_id_last_update'] = auth()->user()->id;
        $this->repository->create($data);       
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('documentos.index');
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
        $this->authorize('editar-documento-dof');
        $documento = DocumentosDof::findOrFail($id);
        $tiposMateria = $this->tipoMateria->get();
        $subTiposMateria = $this->subTipoMateria->get(); 
       //dd($documento);    
        return view('admin.pages.documentosDof.edit',compact('documento', 'subTiposMateria','tiposMateria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('editar-documento-dof');

        if($documento = $this->repository->find($id)){
            redirect()->back();
        }
        $data = $request->all();
        $data['user_id'] = $documento->user_id;
        $data['user_id_last_update'] = auth()->user()->id;
       
        $documento->update($data);

        toast('Documento atualizado com sucesso!','success')->toToast('top') ;
        return redirect()->route('documentos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
