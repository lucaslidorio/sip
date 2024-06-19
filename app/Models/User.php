<?php

namespace App\Models;

use App\Models\Traits\UserACLTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
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
        'matricula',
        'tipo_usuario'
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
        return $this->profile_image_url;
        //return 'https://picsum.photos/300/300';
    }
    
    //pode  ser implementado para retornar o cargo do usuário
    public function adminlte_desc()
    {
        return 'Bem Vindo';
    }
    public function adminlte_profile_url($id = null)
    {

        //dd($id);
        return 'profile/username';
    }

    //Relacionamento para retornar 1 tenant
    public function tenant(){
        return $this->belongsTo(Tenant::class);
    }

    //Relacionamento dados pessoais
   

    public function dadosPessoais()
    {
        return $this->belongsTo(DadosPessoas::class, 'id', 'user_id');
    }

    public function profiles(){
        return $this->BelongsToMany(Profile::class, 'profile_users','user_id',  'profile_id');
    }

    public function documentos_pessoa(){
        return $this->hasMany(DocumentosPessoas::class, 'id', 'user_id');
    }
   
    /**
     * Get the URL of the profile image.
     * Retorna O  URL da imagem do perfil. Se o atributo 'img' de 'dadosPessoais' não estiver vazio,
     * retorna a concatenação da URL da AWS e o atributo 'img' de 'dadosPessoais'.
     * Caso contrário, retorna a concatenação da URL da AWS e o caminho 'uteis/no-image128.jpg'..
     */
    public function getProfileImageUrlAttribute()
{
    return !empty($this->dadosPessoais->img) 
        ? config('app.aws_url').$this->dadosPessoais->img 
        : config('app.aws_url').('uteis/no-image256.jpg');
}

}
