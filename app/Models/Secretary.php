<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secretary extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'sigla',
        'nome_responsavel',
        'telefone',
        'celular',
        'endereco',
        'email',
        'situacao',
        'sobre',
        ];
}
