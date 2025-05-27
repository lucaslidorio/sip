<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlternativasPesquisa extends Model
{
    protected $table = 'alternativas_pesquisa';
    protected $fillable = ['pesquisa_id', 'alternativa'];

    public function pergunta()
    {
        return $this->belongsTo(PerguntasPesquisa::class, 'pergunta_pesquisa_id');
    }
}
