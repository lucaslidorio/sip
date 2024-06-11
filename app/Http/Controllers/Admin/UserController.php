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
        //Pega todos os planos através do injeção do model no contrutor
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
        $tenant = auth()->user()->tenant;        
        $data = $request->all();
        $data['tenant_id'] = $tenant->id;
        $data['password'] = bcrypt($data['password']); // criptografa a senha

        $this->repository->create($data); 
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
        $data = $request->only('name', 'email', 'matricula');
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);
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

    public function profiles($idUser)
    {
        
        $this->authorize('admin');
        $user = $this->repository->find($idUser);

        if (!$user) {
            return redirect()->back();
        }
        $profiles = $user->profiles()->paginate();
        
        
        return view('admin.pages.users.profiles.profiles', compact('profiles', 'user'));      
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

    //Código referente ao perfil do usuário acessado pelo menu superior direito
    // não esta sendo usado, passei para o controller DadosPessoasController

    // public function perfil($id){

    //     $user = $this->repository->find($id);

    //     return view('admin.pages.perfilUsuarios.index', compact('user'));
    // }
}
