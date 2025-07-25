<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpadateSecretary;
use App\Models\Secretary;
use Illuminate\Http\Request;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class SecretaryController extends Controller
{
    private $repository;
    public function __construct(Secretary $Secretary){
        $this->repository = $Secretary;
    }
    
    public function index()
    {
        $this->authorize('ver-secretaria');
        $secretaries = $this->repository->orderBy('situacao','DESC')->paginate(10);
        return view('admin.pages.secretaries.index', compact('secretaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('nova-secretaria');
        return view('admin.pages.secretaries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpadateSecretary $request)
    {
        $this->authorize('nova-secretaria');
        $this->repository->create($request->all());
        
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->back();
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id )
    {
        $this->authorize('ver-secretaria');
        $secretary = $this->repository->where('id', $id)->first();

        if(!$secretary)
            return redirect()->back();

        return view('admin.pages.secretaries.show',[
            'secretary' =>$secretary
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('editar-secretaria');
        $secretary = $this->repository->where('id', $id)->first();

        if(!$secretary){
            return redirect()->back();                       
        }                       
        return view('admin.pages.secretaries.edit',[
            'secretary' => $secretary
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpadateSecretary $request, $id)
    {
        $this->authorize('editar-secretaria');
        $secretary  = $this->repository->where('id', $id)->first();
        if(!$secretary){
            redirect()->back();
        }
        $secretary->update($request->all());
        toast('Secretária atualizada com sucesso!','success')->toToast('top') ;
        return redirect()->route('secretaries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('excluir-secretaria');
        $secretary = $this->repository->where('id', $id)->first();

        if(!$secretary){
            redirect()->back();
        }

        $secretary->delete();
        toast('Secretaria excluida com sucesso!','success')->toToast('top');            
        return redirect()->route('secretaries.index');
    }

    // //Metodo de pesquisa
    // public function search(Request $request)
    // {
    //      $pesquisar = $request->except('_token');
    //      $secretaries = $this->repository->search($request->pesquisa);

    //     return view('admin.pages.secretaries.index', [
    //         'secretaries' => $secretaries,
    //         'pesquisar' => $pesquisar,
    //     ]);
    // }
}
