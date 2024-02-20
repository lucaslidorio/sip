<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoria;
use App\Models\Categoria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoriaController extends Controller
{
    private $repository;
    public function __construct(Categoria $categoria)
    {
        //Pega todos os planos através do injeção do model no contrutor
        $this->repository = $categoria;
    }
    public function home(){
        return view('dashboard');
    } 
//
    public function index() 
    {
        $this->authorize('ver-categoria');
        $categorias = $this->repository->paginate(10);
        return view('admin.pages.categorias.index', [
            'categorias' => $categorias,
        ]); 
    } 
    //
    public function create()
    {
        $this->authorize('nova-categoria');
        return view('admin.pages.categorias.create');
    }
    public function store(StoreUpdateCategoria $request)
    {
        $this->repository->create($request->all()); 
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->back();
        
    }

    public function edit($id)
    {
        $this->authorize('editar-categoria');
        $categoria = $this->repository->where('id', $id)->first();

        if(!$categoria){
            return redirect()->back();
                       
        }                       
        return view('admin.pages.categorias.edit',[
            'categoria' => $categoria
        ]);
    }

    public function update(StoreUpdateCategoria $request, $id){
        $this->authorize('editar-categoria');
        $categoria = $this->repository->where('id', $id)->first();
        if(!$categoria){
            return redirect()->back();
                       
        }

        $categoria->update($request->all());
        toast('Categoria atualizada com sucesso!','success')->toToast('top') ; 
        return redirect()->route('categorias.index');
        
    }


  

    public function destroy($id)
    {
        $this->authorize('excluir-categoria');
        $categoria = $this->repository->where('id', $id)->first();

        if(!$categoria){
            return redirect()->back();
                       
        }       
        $categoria->delete();
        toast('Categoria excluida com sucesso!','success')->toToast('top');            
        return redirect()->route('categorias.index');

    }
    public function search(Request $request)
    {
        $this->authorize('ver-categoria');
         $pesquisar = $request->except('_token');
         $categorias = $this->repository->search($request->pesquisa);

        return view('admin.pages.categorias.index', [
            'categorias' => $categorias,
            'pesquisar' => $pesquisar
        ]);
    }
}
