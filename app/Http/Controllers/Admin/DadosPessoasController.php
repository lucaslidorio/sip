<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DadosPessoas;
use App\Models\DocumentosPessoas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DadosPessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $user, $repository;
    public function __construct(User $user, DadosPessoas $repository)
    {
         $this->user = $user;
         $this->repository = $repository;
    }

    public function index($id)
    {
        if($id != Auth::user()->id){
            return redirect()->route('login');
        }

        $user = $this->user->find($id);
        return view('admin.pages.perfilUsuarios.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
              
        if($request->user_id != Auth::user()->id){
            return redirect()->route('login');
        }
        $dadosPessoa = $this->repository->where('user_id', $request->user_id)->first();   
               
        $dadosPessoa->update($request->all());

        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->back();

        

    }

    public function storeDocumento(Request $request){

       
         $anexo = new DocumentosPessoas();

         $anexoDocumento = $request->only('file');        
         $anexoDocumento['dado_pessoa_id'] = auth()->user()->id;
         $anexoDocumento['type_document_id'] = 5;

         if ($request->hasFile('anexo')) {
             $anexoDocumento['nome_original'] = Str::upper($anexoDocumento['file']->getClientOriginalName());
             $anexoDocumento['anexo'] = $request->anexo->store('documentos_pessoas');
         }
         $anexo->create($anexoDocumento);

        return response()->json(['success', $anexoDocumento]);
        // toast('Cadastro realizado com sucesso!', 'success')->toToast('top');
        // return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
