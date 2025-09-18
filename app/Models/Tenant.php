<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    protected $table = 'tenants';

    protected $fillable = [
    'nome', 
    'slogan',
    'endereco', 
    'numero', 
    'bairro', 
    'cidade', 
    'maps',
    'telefone',
    'celular', 
    'dia_atendimento',
    'cnpj',
    'email', 
    'facebook', 
    'youtube', 
    'instagram',
    'twitter',
    'tiktok', 
    'brasao', 
    'bandeira',
    'favicon',
    'nome_resp_transparencia', 
    'telefone_resp_transparencia',
    'email_resp_transparencia',
    'arquivo_cor_css',
    'template'
    ];

     public function users(){
        return $this->hasMany(User::class);
    }
    public function plan(){
        return $this->belongsTo(Plan::class);
    }
    public function developmentSettings()
    {
        return $this->belongsTo(DevelopmentSetting::class, 'id', 'tenant_id'); 
    }
    public function anexos()
{
    return $this->hasMany(AnexoTenant::class, 'tenants_id');
}
}
