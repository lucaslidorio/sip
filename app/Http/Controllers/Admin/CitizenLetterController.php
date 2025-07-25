<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCitizenLetter;
use App\Models\CitizenLetter;
use Illuminate\Http\Request;

class CitizenLetterController extends Controller
{
    private $repository;
   public function __construct(CitizenLetter $repository)
   {
       $this->repository = $repository;
   }
    public function index()
    {    
        $this->authorize('ver-carta-cidadao');
        $citizenLetters = $this->repository->paginate(10);
        return view('admin.pages.citizenLetters.index', compact('citizenLetters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('nova-carta-cidadao');
        return view('admin.pages.citizenLetters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCitizenLetter $request)
    {
        $this->authorize('nova-carta-cidadao');
        $this->repository->create($request->all());
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('citizenLetters.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('ver-carta-cidadao');
        $citizenLetter = $this->repository->where('id', $id)->first();

        if(!$citizenLetter)
            return redirect()->back();

        return view('admin.pages.citizenLetters.show',[
            'citizenLetter' =>$citizenLetter
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
        $this->authorize('editar-carta-cidadao');
        $citizenLetter  = $this->repository->where('id', $id)->first();
        if(!$citizenLetter){
            redirect()->back();
        }
        return view('admin.pages.citizenLetters.edit', compact('citizenLetter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCitizenLetter $request, $id)
    {
        $this->authorize('editar-carta-cidadao');
        $citizenLetter  = $this->repository->where('id', $id)->first();
        if(!$citizenLetter){
            redirect()->back();
        }
        $citizenLetter->update($request->all());
        toast('Função atualizada com sucesso!','success')->toToast('top') ;
        return redirect()->route('citizenLetters.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('excluir-carta-cidadao');
        $citizenLetter = $this->repository->where('id', $id)->first();

        if(!$citizenLetter){
            redirect()->back();
        }
        $citizenLetter->delete();
        toast('Função excluida com sucesso!','success')->toToast('top');            
        return redirect()->route('citizenLetters.index');
    }
}
