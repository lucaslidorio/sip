<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCommission;
use App\Models\Commission;
use App\Models\Functions;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    private $repository, $function;

    public function __construct(Commission $commission, Functions $function)
    {
        $this->repository = $commission;
        $this->function = $function;
    }
   
    public function index()
    {
        $commissions = $this->repository->paginate(10);
        return view('admin.pages.commissions.index', compact('commissions'));
    }

    
    public function create()
    {
        return view('admin.pages.commissions.create');
    }

  
    public function store(StoreUpdateCommission $request)
    {
        $this->repository->create($request->all());
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->back();
    }
    
    public function show($id)
    {
       
    }

    public function edit($id)
    {
       $commission = $this->repository->where('id', $id)->first();
       if (!$commission) {
           redirect()->back();
       }
       return view('admin.pages.commissions.edit', compact('commission'));

    }
  
    public function update(StoreUpdateCommission $request, $id)
    {
        $commission = $this->repository->where('id', $id)->first();
        
        if (!$commission) {
            redirect()->back();
        }  

        $commission->update($request->all());
        toast('Comissão atualizada com sucesso!','success')->toToast('top');            
        return redirect()->route('commissions.index');
    }

   
    public function destroy($id)
    {
        $commission = $this->repository->where('id', $id)->first();
        
        if (!$commission) {
            redirect()->back();
        }

        $commission->delete();
        toast('Comissão excluida com sucesso!','success')->toToast('top');            
        return redirect()->route('commissions.index');
    }


    public function search (Request $request){

        $pesquisar = $request->except('_token');
        $commissions = $this->repository->search($request->pesquisa);

        return view('admin.pages.commissions.index', [
            'commissions' =>$commissions,
            'pesquisar' =>$pesquisar
        ]);
    }
    // public function members($id)
    // {
    //    $commission = $this->repository->where('id', $id)->first();
    //    if (!$commission) {
    //        redirect()->back();
    //    } 


       
       
    //    return view('admin.pages.commissions.members.index', compact('commission'));

    // }

}
