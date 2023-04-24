<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Councilor;
use App\Models\Legislature;
use App\Models\LesgislatureCouncilors;
use App\Models\Section;
use Illuminate\Http\Request;

class LegislatureController extends Controller
{
    private $repository, $councilorLegislature, $councilor;


    public function __construct(Legislature $legislature, 
        LesgislatureCouncilors $councilorLegislature,
        Councilor $councilor,
        )
    {
        $this->repository = $legislature;
        $this->councilorLegislature = $councilorLegislature;
        $this->councilor = $councilor;
        

       
        
    }
    public function index()
    {
        $legislatures = $this->repository->orderBy('ordem', 'DESC')->paginate(10);
        
        
        return view('admin.pages.legislatures.index', compact('legislatures'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $legislature = $this->repository->where('id', $id)->first();
       if (!$legislature) {
           redirect()->back();
       }
       return view('admin.pages.legislatures.show', compact('legislature'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    
    //Inicio do crud de vereadores das legislaturas
    public function councilors($id){               
                 
        $legislature = $this->repository->where('id', $id)->first();
        $councilorsLegislature = $this->councilorLegislature->where('legislature_id', $id)->paginate(10);
         
        return view('admin.pages.legislatures.members.index', [
            'legislature' => $legislature,
            'councilorsLegislature' =>$councilorsLegislature,                    
     ]);
    }

    public function councilorsCreate($id){
        
        $legislature = $this->repository->where('id', $id)->first();         
        if (!$legislature) {
            redirect()->back();
        }  
        $councilors = $this->councilor->get();        
        return view('admin.pages.legislatures.members.create', [            
            'legislature' => $legislature,
            'councilors' => $councilors,                    
        ]);      
    }
    public function councilorsStore(Request $request, $id){
        //$directorTable = $this->repository->where('id', $id)->first();  
    
        $legislatureCouncilors = new LesgislatureCouncilors();
        $dados = $request->except('_token');       
        $legislatureCouncilors->create($dados);
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->back();
    }

    public  function councilorsDestroy($id){

        $councilorLegislature =$this->councilorLegislature->where('id', $id)->first();             
       
        //dd($memberFunction);
        if (!$councilorLegislature) {
            redirect()->back();
        }

        $councilorLegislature->delete();
        toast('Vereador excluido com sucesso!','success')->toToast('top');            
        return redirect()->back();
    }

}
