<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao'];

    //Pega as permissão do perfil
    public function permissions(){

        return $this->BelongsToMany(Permission::class, 'permission_profile');
    }
    public function plans(){
        return $this->BelongsToMany(Plan::class, 'plan_profile' );
    }
    //Pega as permissões ainda não vinculada ao perfil
    public function permissionsAvailable( $filter = null){

            $permissions = Permission::whereNotIn('id', function($query){
            $query->select('permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id={$this->id}");
        })
        ->where(function($queryfilter) use($filter){
            if($filter)
            $queryfilter ->where('permissions.nome', 'LIKE', "%{$filter}%" );
        })       
        ->paginate();          

        return $permissions;
    }




}

