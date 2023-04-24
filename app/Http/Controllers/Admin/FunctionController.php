<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateFunction;
use App\Models\Functions;
use Illuminate\Http\Request;

class FunctionController extends Controller
{
    private $repository;
    

    public function __construct(Functions $function)
    {
        $this->repository = $function;       
    }
    public function index()
    {
        $functions = $this->repository->paginate(10);
        return view('admin.pages.functions.index', compact('functions'));
    }

    public function create()
    {
        return view('admin.pages.functions.create');
    }

       public function store(StoreUpdateFunction $request)
    {
        $this->repository->create($request->all());
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->back();
        
    }

  
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $function =$this->repository->where('id', $id)->first();
        return view('admin.pages.functions.edit', compact('function'));
    }

    
    public function update(StoreUpdateFunction $request, $id)
    {
        $function  = $this->repository->where('id', $id)->first();
        if(!$function){
            redirect()->back();
        }
        $function->update($request->all());
        toast('Função atualizada com sucesso!','success')->toToast('top') ;
        return redirect()->route('functions.index');
        
    }
   
    public function destroy($id)
    {
        $function = $this->repository->where('id', $id)->first();

        if(!$function){
            redirect()->back();
        }
        $function->delete();
        toast('Função excluida com sucesso!','success')->toToast('top');            
        return redirect()->route('functions.index');
    }

    public function search (Request $request){

        $pesquisar = $request->except('_token');
        $functions = $this->repository->search($request->pesquisa);

        return view('admin.pages.functions.index', [
            'functions' =>$functions,
            'pesquisar' =>$pesquisar
        ]);
    }
}
