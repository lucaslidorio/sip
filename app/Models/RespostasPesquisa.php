<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RespostasPesquisa extends Model
{
    protected $table = 'respostas_pesquisas';
    protected $fillable = ['id', 'questionario_id', 'pergunta_pesquisa_id', 'alternativa_pesquisa_id'];
}
