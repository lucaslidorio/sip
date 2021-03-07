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

    public function permissionsAvailable($idProfile){

        $profile =  $this->profile->find($idProfile);
       
        if(!$profile){
            return redirect()->back();
        }

        $permissions = $this->permission->paginate();


        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions'));


    }
}
