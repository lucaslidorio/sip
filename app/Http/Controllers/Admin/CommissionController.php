<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCommission;
use App\Http\Requests\StoreUpdateCommissonMembers;
use App\Models\Commission;
use App\Models\CommissionMembers;
use App\Models\Councilor;
use App\Models\Functions;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    private $repository, $function, $councilor, $commissionMembers;

    public function __construct(Commission $commission, Functions $function, Councilor $councilor,
    CommissionMembers $commissionMembers)
    {
        $this->repository = $commission;
        $this->function = $function;
        $this->councilor = $councilor;
        $this->commissionMembers = $commissionMembers;
       
    }
   
   
    public function index()
    {
        $this->authorize('ver-comissao');
        $commissions = $this->repository->paginate(10);
        return view('admin.pages.commissions.index', compact('commissions'));
     
    }

    
    public function create()
    {
        $this->authorize('nova-comissao');
        return view('admin.pages.commissions.create');
    }

  
    public function store(StoreUpdateCommission $request)
    {
        $this->authorize('nova-comissao');
        $this->repository->create($request->all());
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->back();
    }
    
    public function show($id)
    {
       
    }

    public function edit($id)
    {
        $this->authorize('editar-comissao');
       $commission = $this->repository->where('id', $id)->first();
       if (!$commission) {
           redirect()->back();
       }
       return view('admin.pages.commissions.edit', compact('commission'));

    }
  
    public function update(StoreUpdateCommission $request, $id)
    {
        $this->authorize('editar-comissao');
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
        $this->authorize('excluir-comissao');
        $commission = $this->repository->where('id', $id)->first();
        
        if (!$commission) {
            redirect()->back();
        }

        $commission->delete();
        toast('Comissão excluida com sucesso!','success')->toToast('top');            
        return redirect()->route('commissions.index');
    }


    public function search (Request $request){
        $this->authorize('ver-comissao');

        $pesquisar = $request->except('_token');
        $commissions = $this->repository->search($request->pesquisa);

        return view('admin.pages.commissions.index', [
            'commissions' =>$commissions,
            'pesquisar' =>$pesquisar
        ]);
    }

    //Inicio do crud de membros das comissões
    public function members($id){
        $this->authorize('ver-comissao');
        $dataCommission= CommissionMembers::with('members', 'functions')->where('commission_id', $id)->get();          
        
        $commission = $this->repository->where('id', $id)->first();
        
         return view('admin.pages.commissions.members.index', [
         'dataCommission' => $dataCommission,
         'commission' => $commission
        
     ]);
    }
    public function membersCreate($id){
        $this->authorize('nova-comissao');
        $commission = $this->repository->where('id', $id)->first();
        $councilors = $this->councilor->get();
        $functions = $this->function->get();
        return view('admin.pages.commissions.members.create', [
            
            'commission' => $commission,
            'councilors' => $councilors,
            'functions' => $functions,           
        ]);      
    }

    public function membersStore(StoreUpdateCommissonMembers $request, $id){
        $this->authorize('nova-comissao');
        $commission = $this->repository->where('id', $id)->first();
    
    
       $commissionMembersfunctions = new CommissionMembers();
       $dados = $request->except('_token');
       $commissionMembersfunctions->create($dados);

        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->back();
    }

    public  function membersDestroy($id){

        $this->authorize('excluir-comissao');
        $memberFunction =$this->commissionMembers->where('id', $id)->first();
               
       
        //dd($memberFunction);
        if (!$memberFunction) {
            redirect()->back();
        }

        $memberFunction->delete();
        toast('Membro excluido com sucesso!','success')->toToast('top');            
        return redirect()->back();
    }

}
