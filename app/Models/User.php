<?php

namespace App\Models;

use App\Models\Traits\UserACLTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, UserACLTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id',
        'name',
        'email',
        'password',
        'matricula'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //pode retornar a imagem do usuário
    public function adminlte_image(){
        return 'https://picsum.photos/300/300';
    }
    
    //pode  ser implementado para retornar o cargo do usuário
    public function adminlte_desc()
    {
        return 'Bem Vindo';
    }
    public function adminlte_profile_url()
    {
        return 'profile/username';
    }

    //Relacionamento para retornar 1 tenant
    public function tenant(){
        return $this->belongsTo(Tenant::class);
    }

    public function profiles(){
        return $this->BelongsToMany(Profile::class, 'profile_users','user_id',  'profile_id');
    }
}
