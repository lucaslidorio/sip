<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposition extends Model
{
    use HasFactory;
    protected $table = 'propositions';

    protected $fillable = [
     'user_id',
     'proceeding_situation_id',
     'type_proposition_id',
     'numero',
     'data',
     'descricao',
     
    ];

    //Relacionamento a situaçao do processo, mostra qual a situação de tramitação
    public function situation(){
        return $this->belongsTo(ProceedingSituation::class,'proceeding_situation_id', 'id' );
    }

    public function type_proposition(){
        return $this->belongsTo(TypeProposition::class, 'type_proposition_id', 'id');
    }

    public function attachments(){
        return $this->hasMany(AttachmentProposition::class);
    }

    //relaciona com a table councilor 'para pegar o autor da proposição'
    public function author(){
        return $this->belongsToMany(Councilor::class, 'author_propositions');

    }

    public function votos_propositura(){
        return $this->belongsToMany(TipoVoto::class, 'voto_vereador_proposituras')->withPivot('session_id','councilor_id','tipo_voto_id');
    }

    public function votos()
    {
        return $this->belongsToMany(VotoVereadorPropositura::class, 'voto_vereador_proposituras', 'proposition_id', 'tipo_voto_id')
            ->withPivot('councilor_id', 'tipo_voto_id');
    }

}
