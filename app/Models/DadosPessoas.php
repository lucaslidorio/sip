<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DadosPessoas extends Model
{
    use HasFactory;

    protected $table = 'dados_pessoas';
    protected $fillable = [
        'user_id', 
        'tipo_pessoa',
        'natureza_juridica',
        'enquadramento',
        'nome_fantasia',
        'razao_social',
        'cnpj',
        'inscricao_estadual',
        'data_abertura',
        'site',
        'email',
        'cep',
        'endereco',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'telefone',
        'celular',     
    ];

    public function usuario() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // public function documento_pessoa() {
    //     return $this->hasMany(DocumentosPessoas::class, , 'dado_pessoa_id');
    // }
    public function documentosPessoas()
    {
        return $this->hasMany(DocumentosPessoas::class, 'dado_pessoa_id', 'id');
    }
}

