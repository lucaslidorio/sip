<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
//use App\Http\Requests\StoreUpdateCategoria;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    private $repository;
    public function __construct(User $user)
    {
        //Pega todos os planos atravé do injeção do model no contrutor
        $this->repository = $user;
    }

    public function index()
    {
        $users = $this->repository->paginate(10);
        return view('admin.pages.users.index', [
            'users' => $users,
        ]);
    }
    
    public function create()
    {
        return view('admin.pages.users.create');
    }
    public function store(StoreUpdateUser $request)
    {
       
        $this->repository->create($request->all()); 
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->back();
        
    }

    public function edit($id)
    {
        $user = $this->repository->where('id', $id)->first();

        if(!$user){
            return redirect()->back();
                       
        }                       
        return view('admin.pages.users.edit',[
            'user' => $user
        ]);
    }

    public function update(StoreUpdateUser $request, $id){

        $user = $this->repository->where('id', $id)->first();
        if(!$user){
            return redirect()->back();
                       
        }

        $user->update($request->all());
        toast('Usuário atualizado com sucesso!','success')->toToast('top') ; 
        return redirect()->route('users.index');
        
    }

    public function show($id )
    {
        $user = $this->repository->where('id', $id)->first();

        if(!$user)
            return redirect()->back();

        return view('admin.pages.users.show',[
            'user' =>$user
        ]);
    }


  

    public function destroy($id)
    {
        $user = $this->repository->where('id', $id)->first();

        if(!$user){
            return redirect()->back();
                       
        }       
        $user->delete();
        toast('Usuário excluido com sucesso!','success')->toToast('top');            
        return redirect()->route('users.index');

    }
    public function search(Request $request)
    {
         $pesquisar = $request->except('_token');
         $users = $this->repository->search($request->pesquisa);

        return view('admin.pages.users.index', [
            'users' => $users,
            'pesquisar' => $pesquisar
        ]);
    }
}
