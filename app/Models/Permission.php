<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'descricao'];


   //Pega as perfis da permissão
   public function profiles(){

    return $this->BelongsToMany(Profile::class, 'permission_profile');
}


}
