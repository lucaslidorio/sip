<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfiguracaoOuvidoria extends Model
{
    protected $fillable =['id','nome_responsavel', 'email', 'telefone', 'celular','endereco_fisico', 'dias_atendimento'];
    protected $table = 'configuracao_ouvidorias'; 
}
