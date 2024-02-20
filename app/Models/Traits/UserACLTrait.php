<?php
namespace App\Models\Traits;

use Termwind\Components\Raw;

trait UserACLTrait{
    
    public function permissions(){

        
        $permissions = [];
        foreach ($this->profiles as $profile) {            
            foreach ($profile->permissions  as $permission) {
                array_push($permissions, $permission->nome);
            }
        }

        return $permissions;


        // $tenant = $this->tenant()->first();
        // $plan =  $tenant->plan;

        // $permissions = [];
        // foreach ($plan->profiles as $profile) {            
        //     foreach ($profile->permissions  as $permission) {
        //         array_push($permissions, $permission->nome);
        //     }
        // }

        // return $permissions;     

    }
    //tem permissão
    public function hasPermission(String $permissionName):bool
    {
        return in_array($permissionName, $this->permissions());
    }

    public function isAdmin():bool
    {
        return in_array($this->email,  config('acl.admins'));
    }

    public function isTenant():bool
    {
        return !in_array($this->email,  config('acl.admins'));
    }
}
