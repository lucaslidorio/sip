<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questionario extends Model
{
    protected $table = 'questionarios';
    protected $fillable = ['titulo',  'descricao', 'ativo'];

    public function perguntas()
{
    return $this->hasMany(PerguntasPesquisa::class);
}
}
