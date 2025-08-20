<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class TenantController extends Controller
{
    private $repository;
    public function __construct(Tenant $tenant)
    {
        $this->repository = $tenant;
        
    }
    public function index()
    {
        $this->authorize('ver-orgao');
        $tenants = $this->repository->paginate();
        return view('admin.pages.tenants.index', compact('tenants'));
    }

   
    public function create()
    {
        $this->authorize('novo-orgao');
        return view('admin.pages.tenants.create');   
    }

    
    public function store(Request $request)
    {
        $this->authorize('novo-orgao');
        $dadosTenant = new Tenant();
        //Pega os dados dos input especificos do post
        $dadosTenant = $request->all();
        //pega usuário autenticado       
         
        //Upload de da imagem de destaque
        if($request->hasFile('brasao') && $request->brasao->isValid()){
            $dadosTenant['brasao'] = $request->brasao->store('tenants');
        } 
        if($request->hasFile('bandeira') && $request->bandeira->isValid()){
            $dadosTenant['bandeira'] = $request->bandeira->store('tenants');
        } 
        if($request->hasFile('favicon') && $request->favicon->isValid()){
            $dadosTenant['favicon'] = $request->favicon->store('tenants');
        }           
        //Grava os dados na tabela post
        $this->repository->create($dadosTenant);              
      
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->back();
    }
  
    public function show($id)
    {
        $this->authorize('ver-orgao');
        $tenant = $this->repository->where('id', $id)->first();

        if(!$tenant)
            return redirect()->back();

        return view('admin.pages.tenants.show',[
            'tenant' =>$tenant
        ]);
    }
 
    
    public function edit($id)
    {
        $this->authorize('editar-orgao');
        $tenant = $this->repository->where('id', $id)->first();
        
        if(!$tenant){
            return redirect()->back();                       
        }                       
        return view('admin.pages.tenants.edit',[
            'tenant' => $tenant,
                    
        ]);
    }

    
    public function update(Request $request, $id)
    {
        $this->authorize('editar-orgao');
         //recupera o post pelo id 
         $tenant  = $this->repository->where('id', $id)->first();
         if(!$tenant){
             redirect()->back();
         }      
        $dadosTenant = $request->all();
         //dd($dadosTenant);
        
          //verifica se existe um arquivo e se é do tipo image e faz o upload 
          //antes de fazer salvar, remove a imagem já existente    
          if ($request->hasFile('brasao') && $request->file('brasao')->isValid()) {
            // Se já havia um arquivo, tenta apagar com segurança
            $oldPath = $tenant->brasao; // pode ser null        
            // Salva o novo arquivo (ajuste o disk se precisar)
            // ex.: Storage::disk('s3')->putFile('tenants', $request->file('brasao'));
            $newPath = $request->file('brasao')->store('tenants'); // disk default        
            // Atualiza o dado que será salvo no model
            $dadosTenant['brasao'] = $newPath;
            // Apaga o antigo, se existir
            if ($oldPath && Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
        }
         if ($request->hasFile('bandeira') && $request->file('bandeira')->isValid()) {  
            $oldPath = $tenant->bandeira;      
            $newPath = $request->file('bandeira')->store('tenants');      
            $dadosTenant['bandeira'] = $newPath; // Apaga o antigo, se existir
            if ($oldPath && Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
        }
        if ($request->hasFile('favicon') && $request->file('favicon')->isValid()) {// Se já havia um arquivo, tenta apagar com segurança
            $oldPath = $tenant->favicon; 
            $newPath = $request->file('favicon')->store('tenants'); 
            $dadosTenant['favicon'] = $newPath;
            if ($oldPath && Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
        }
         //Atualila a tabela post
         $tenant->update($dadosTenant); 
         // Limpa o cache do template
         Cache::forget('tenant_template');
         toast('Cadastro atualizado com sucesso!','success')->toToast('top') ;     
         return redirect()->back();   
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
}
