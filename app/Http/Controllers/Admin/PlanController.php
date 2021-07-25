<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;


class PlanController extends Controller
{
    private $repository;
    public function __construct(Plan $plan)    
    {
        $this->repository = $plan;
    }
    public function index()
    {
        $plans = $this->repository->latest()->paginate(10);
        return view('admin.pages.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('plans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = $this->repository->find($id);
        if(!$plan){
            redirect()->back();
        }
        return view('admin.pages.plans.edit' ,compact('plan'));        
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
        if($plan = $this->repository->find($id)){
            redirect()->back();
        }
        $plan->update($request->all());
        toast('Perfil atualizado com sucesso!','success')->toToast('top') ;
        return redirect()->route('plans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = $this->repository->where('id', $id)->first();
        if(!$plan){
            return redirect()->back();
        }       
        $plan->delete();
        toast('Perfil excluido com sucesso!','success')->toToast('top');            
        return redirect()->route('plans.index');
    }
}
