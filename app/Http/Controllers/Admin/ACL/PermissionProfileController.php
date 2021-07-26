<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    protected $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;
        
        $this->middleware('can:admin');
        
    }

    //recupera as permissão do perfil
    public function permissions($idProfile)
    {
      //recupera o perfil através do id, se não encontar faz o redirec back

        $profile =  $this->profile->find($idProfile);
       
        if(!$profile){
            return redirect()->back();
        }
         $permissions = $profile->permissions()->paginate();

         return view('admin.pages.profiles.permissions.permissions', compact('profile', 'permissions'));

    }
    //recupera as perfil vinculado a permissão
    public function profiles($idPermission)
    {  
        $permission =  $this->permission->find($idPermission);
       
        if(!$permission){
            return redirect()->back();
        }
         $profiles = $permission->profiles()->paginate();

         return view('admin.pages.permissions.profiles.profiles', compact('permission', 'profiles'));

    }
    //Lista as permissoes disponiveis  para o perfil
    public function permissionsAvailable(Request $request, $idProfile){

        $profile =  $this->profile->find($idProfile);       
        if(!$profile){
            return redirect()->back();
        }

        $filters = $request->except('_token');
        $permissions = $profile->permissionsAvailable($request->pesquisa);

       // $permissions = $profile->permissionsAvailable();
        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions','filters' ));


    }
    //Vincula permissão com o perfil
    public function attachPermissionProfile(Request $request, $idProfile){

        $profile =  $this->profile->find($idProfile);       
        if(!$profile){
            return redirect()->back();
        }

        if(!$request->permissions  || count($request->permissions) == 0){
            toast('É necessário escolher uma permissão','error')->toToast('top');
            return redirect()->back();
            
        }
    
        $profile->permissions()->attach($request->permissions);
        toast('Permissão(s) vinculada com sucesso!','success')->toToast('top');
        return redirect()->route('profiles.permissions', $profile->id);

    }
    

    //Desvincula permissão do perfil
    public function detachPermissionProfile($idProfile, $idPermission){
        
        $profile =  $this->profile->find($idProfile); 
        $permission =  $this->permission->find($idPermission);  

        if(!$profile || !$idPermission){
            return redirect()->back();
        }

        $profile->permissions()->detach($permission);
        toast('Permissão(s) desvinculada com sucesso!','success')->toToast('top');
        return redirect()->back();
        //return redirect()->route('profiles.permissions', $profile->id);
    }
}
