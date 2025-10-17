<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlternativasPesquisa extends Model
{
    protected $table = 'alternativas_pesquisa';
    protected $fillable = ['pergunta_pesquisa_id', 'alternativa'];

    public function pergunta()
    {
        return $this->belongsTo(PerguntasPesquisa::class, 'pergunta_pesquisa_id');
    }
    public function respostas()
{
    return $this->hasMany(RespostasPesquisa::class, 'alternativa_pesquisa_id');
}
}
