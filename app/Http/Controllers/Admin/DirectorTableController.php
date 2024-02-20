<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDirectorTable;
use App\Http\Requests\StoreUpdateDirectorTableMemberFunctions;
use App\Models\Biennium;
use App\Models\Councilor;
use App\Models\DirectorTable;
use App\Models\DirectorTableMemberFunctions;
use App\Models\Functions;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class DirectorTableController extends Controller
{
    private $repository, $biennium, $councilor, $function, $directorTableMemberFunctions;

    public function __construct(DirectorTable $directorTable, Biennium $biennium,
        Councilor $councilor, Functions $function, DirectorTableMemberFunctions $directorTableMemberFunctions)
    {
        $this->repository = $directorTable;
        $this->biennium = $biennium;
        $this->councilor = $councilor;
        $this->function = $function;
        $this->directorTableMemberFunctions = $directorTableMemberFunctions;

    }
    public function index()
    {
        $this->authorize('ver-mesa-diretora');
        $directorTables = $this->repository->paginate(10);
        return view('admin.pages.directorTables.index', compact('directorTables'));
    }
 
    public function create()
    {
        $this->authorize('nova-mesa-diretora');
        $bienniuns = $this->biennium->orderBy('id', 'DESC')->get();   
       
        return view('admin.pages.directorTables.create', compact('bienniuns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateDirectorTable $request)
    {
        $this->authorize('nova-mesa-diretora');
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
        $this->authorize('editar-mesa-diretora');
        $bienniuns = $this->biennium->orderBy('id', 'DESC')->get(); 
        $directorTable = $this->repository->where('id', $id)->first();
       if (!$directorTable) {
           redirect()->back();
       }
       return view('admin.pages.directorTables.edit', compact('directorTable', 'bienniuns'));

    }

       public function update(StoreUpdateDirectorTable $request, $id)
    {
        $this->authorize('editar-mesa-diretora');
        $directorTable = $this->repository->where('id', $id)->first();
        
        if (!$directorTable) {
            redirect()->back();
        }  

        $directorTable->update($request->all());
        toast('Mesa Diretora atualizada com sucesso!','success')->toToast('top');            
        return redirect()->route('directorTables.index');
    }

   
    public function destroy($id)
    {
        $this->authorize('excluir-mesa-diretora');
        $directorTable = $this->repository->where('id', $id)->first();
        
        if (!$directorTable) {
            redirect()->back();
        }

        $directorTable->delete();
        toast('Mesa Diretoraexcluida com sucesso!','success')->toToast('top');            
        return redirect()->route('directorTables.index');
    }

    
    public function search (Request $request){

        $this->authorize('ver-mesa-diretora');
        $pesquisar = $request->except('_token');
        $directorTable = $this->repository->search($request->pesquisa);

        return view('admin.pages.directorTables.index', [
            'directorTables' =>$directorTable,
            'pesquisar' =>$pesquisar
        ]);
    }


    //Inicio do crud de membros das comissões
    public function members($id){
        $this->authorize('ver-mesa-diretora');
        $dataTable= DirectorTableMemberFunctions::with('members', 'functions')->where('director_table_id', $id)->get();          
        $directorTable = $this->repository->where('id', $id)->first();
         
        return view('admin.pages.directorTables.members.index', [
            'dataTable' => $dataTable,
            'directorTable' => $directorTable
        
     ]);
    }
    public function membersCreate($id){
        $this->authorize('nova-mesa-diretora');
        $directorTable = $this->repository->where('id', $id)->first();
        $councilors = $this->councilor->get();
        $functions = $this->function->get();
        return view('admin.pages.directorTables.members.create', [
            
            'directorTable' => $directorTable,
            'councilors' => $councilors,
            'functions' => $functions,           
        ]);      
    }

    public function membersStore(StoreUpdateDirectorTableMemberFunctions $request, $id){
        $this->authorize('nova-mesa-diretora');
        $directorTable = $this->repository->where('id', $id)->first();   
    
       $directorTableMembersfunctions = new DirectorTableMemberFunctions();
       $dados = $request->except('_token');       
       $directorTableMembersfunctions->create($dados);
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->back();
    }

    public  function membersDestroy($id){
        $this->authorize('excluir-mesa-diretora');
        $directorTableMember =$this->directorTableMemberFunctions->where('id', $id)->first();             
       
        //dd($memberFunction);
        if (!$directorTableMember) {
            redirect()->back();
        }

        $directorTableMember->delete();
        toast('Membro excluido com sucesso!','success')->toToast('top');            
        return redirect()->back();
    }

}
