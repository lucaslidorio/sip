<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerguntasPesquisa extends Model
{
    protected $table = 'perguntas_pesquisa';
    protected $fillable = ['numero','pergunta', 'questionario_id'];

    public function questionario()
    {
        return $this->belongsTo(Questionario::class);
    }

    public function alternativas()
    {
        return $this->hasMany(AlternativasPesquisa::class, 'pergunta_pesquisa_id');
    }
    public function respostas()
    {
        return $this->hasManyThrough(
            RespostasPesquisa::class,
            AlternativasPesquisa::class,
            'pergunta_pesquisa_id', // foreign key em Alternativa
            'alternativa_pesquisa_id', // foreign key em Resposta
            'id',
            'id'
        );
    }
}
