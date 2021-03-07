<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePermission;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    
    protected $repository;

    public function __construct(Permission $permission)
    {
        $this->repository = $permission;
    }

    public function index()
    {
        $permissions = $this->repository->paginate(10);

        return view('admin.pages.permissions.index', compact('permissions'));
    }

    
    public function create()
    {
        return view( 'admin.pages.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePermission $request)
    {
        $this->repository->create($request->all());
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;  
        return redirect()->route('permissions.index');
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $permission = $this->repository->find($id);
        if(!$permission){
            redirect()->back();
        }
        return view('admin.pages.permissions.edit' ,compact('permission'));
    }

  
    public function update(StoreUpdatePermission $request, $id)
    {
        if($permission = $this->repository->find($id)){
            redirect()->back();
        }
        $permission->update($request->all());
        toast('Perfil atualizado com sucesso!','success')->toToast('top') ;
        return redirect()->route('permissions.index');
    }
    
    public function destroy($id)
    {
        $permission = $this->repository->where('id', $id)->first();

        if(!$permission){
            return redirect()->back();
                       
        }       
        $permission->delete();
        toast('Perfil excluido com sucesso!','success')->toToast('top');            
        return redirect()->route('permissions.index');
    }

}
