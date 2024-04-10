<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSetores;
use App\Models\Secretary;
use App\Models\Setores;
use Illuminate\Http\Request;

class SetoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $repository, $secretary;
    
    public function __construct(Setores $setores, Secretary $secretary)
    {
        $this->repository = $setores;
        $this->secretary = $secretary;
        
    }
    public function index()
    {
        $this->authorize('ver-setor');
        $setores = $this->repository->paginate(10);

        return view('admin.pages.setores.index', [
            'setores' => $setores,
        ]);         
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $secretaries = $this->secretary->all();   
        $this->authorize('novo-setor');
            return view('admin.pages.setores.create', compact('secretaries'));    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateSetores $request)
    {
        //dd($request->all());
        $this->authorize('novo-setor');
        $this->repository->create($request->all());
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
        $this->authorize('editar-setor');
        $setor = $this->repository->where('id', $id)->first();
        $secretaries = $this->secretary->all();
        if(!$setor){
            return redirect()->back();                       
        }                       
        return view('admin.pages.setores.edit',[
            'setor' => $setor,
            'secretaries' => $secretaries,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateSetores $request, string $id)
    {
        $this->authorize('editar-setor');
        $setor = $this->repository->where('id', $id)->first();
        if(!$setor){
            return redirect()->back();
                       
        }

        $setor->update($request->all());
        toast('Setor atualizado com sucesso!','success')->toToast('top') ; 
        return redirect()->route('setores.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('excluir-setor');
        $setor = $this->repository->where('id', $id)->first();

        if(!$setor){
            return redirect()->back();                       
        }       
        $setor->delete();
        toast('Setor excluido com sucesso!','success')->toToast('top');            
        return redirect()->route('setores.index');
    }
}
