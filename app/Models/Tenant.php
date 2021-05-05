<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    protected $table = 'tenants';

    protected $fillable = ['nome', 'endereco', 'numer', 'bairro', 'cidade', 'telefone',
    'celular', 'dia_atendimento','cnpj','email', 'facebook', 'youtube', 'instagram',
     'twiter', 'brasao', 'bandeira'];

}
