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



}

