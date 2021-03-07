<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProfile;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $repository;

    public function __construct(Profile $profile)
    {
        $this->repository = $profile;
    }

    public function index()
    {
        $profiles = $this->repository->paginate(10);

        return view('admin.pages.profiles.index', compact('profiles'));
    }

    
    public function create()
    {
        return view( 'admin.pages.profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProfile $request)
    {
        $this->repository->create($request->all());
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;  
        return redirect()->route('profiles.index');
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $profile = $this->repository->find($id);
        if(!$profile){
            redirect()->back();
        }
        return view('admin.pages.profiles.edit' ,compact('profile'));
    }

  
    public function update(StoreUpdateProfile $request, $id)
    {
        if($profile = $this->repository->find($id)){
            redirect()->back();
        }
        $profile->update($request->all());
        toast('Perfil atualizado com sucesso!','success')->toToast('top') ;
        return redirect()->route('profiles.index');
    }
    
    public function destroy($id)
    {
        $profile = $this->repository->where('id', $id)->first();

        if(!$profile){
            return redirect()->back();
                       
        }       
        $profile->delete();
        toast('Perfil excluido com sucesso!','success')->toToast('top');            
        return redirect()->route('profiles.index');
    }

    public function search(Request $request){

        $pesquisar = $request->only('pesquisa');      
       
        $profiles = $this->repository
                        ->where(function($query) use ($request){
                            
                            if($request->pesquisa){
                                $query->where('nome', $request->pesquisa)
                                ->orWhere('descricao', 'LIKE', "%{$request->pesquisa}%");
                            } 
                        })
                        ->paginate(10);

                        return view('admin.pages.profiles.index', compact('profiles', 'pesquisar'));
        
    }

  

    
}
