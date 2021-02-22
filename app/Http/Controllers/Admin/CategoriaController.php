<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CategoriaController extends Controller
{
    private $repository;
    public function __construct(Categoria $categoria)
    {
        //Pega todos os planos atravé do injeção do model no contrutor
        $this->repository = $categoria;
    }

    public function index()
    {
        $categorias = $this->repository->all();
        return view('admin.pages.categorias.index', [
            'categorias' => $categorias,
        ]);
    }
    public function create()
    {
        return view('admin.pages.categorias.create');
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $data['url'] = Str::kebab($request->nome);

        $this->repository->create($data); 
        toast('Cadastro realizado com sucesso!','success');      
        return redirect()->back();
        
    }

    public function destroy($id)
    {
        $categoria = $this->repository->where('id', $id)->first();

        if(!$categoria){
            return redirect()->back();
            
            
        }
            
       
        $categoria->delete();
        toast('Categoria excluida com sucesso!','success');        
        return redirect()->route('categorias.index');

    }
}
