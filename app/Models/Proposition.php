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
    protected $casts = [
        'data' => 'date',
    ];
 //Relacionamentos Novos
 // Relacionamento com o Tipo de Propositura
    public function tipo()
    {
        return $this->belongsTo(TypeProposition::class, 'type_proposition_id');
    }
    public function pareceres()
    {
        return $this->hasMany(SeemCommission::class, 'proposition_id', 'id');
    }

    // Relacionamento com a Situação (Proceeding Situation)
    public function situacao()
    {
        return $this->belongsTo(ProceedingSituation::class, 'proceeding_situation_id');
    }

    // Relacionamento com os Autores (Vereadores)
    public function autores()
    {
        return $this->belongsToMany(Councilor::class, 'author_propositions', 'proposition_id', 'councilor_id');
    }

    public function votos()
    {
        return $this->hasMany(VotoVereadorPropositura::class, 'proposition_id');
    }




    //Relacionamento antigos
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

    
   

}
