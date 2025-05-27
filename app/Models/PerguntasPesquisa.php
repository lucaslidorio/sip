<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerguntasPesquisa extends Model
{
    protected $table = 'perguntas_pesquisa';
    protected $fillable = ['pergunta', 'questionario_id'];

    public function questionario()
    {
        return $this->belongsTo(Questionario::class);
    }

    public function alternativas()
    {
        return $this->hasMany(AlternativasPesquisa::class, 'pergunta_pesquisa_id');
    }

}
