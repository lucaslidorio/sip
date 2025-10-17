<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotoVereadorPropositura extends Model
{
    use HasFactory;
    protected $table = 'voto_vereador_proposituras';
    protected $fillable = ['proposition_id', 'session_id', 'councilor_id', 'tipo_voto_id'];
    

    // RELACIONAMENTO NOVOS

    public function vereador()
    {
        return $this->belongsTo(Councilor::class, 'councilor_id','id');
    }

    public function tipoVoto()
    {
        return $this->belongsTo(TipoVoto::class, 'tipo_voto_id');
    }

    public function sessao()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    public function propositura()
    {
        return $this->belongsTo(Proposition::class, 'proposition_id', 'id');
    }




   // RELACIONAMENTOS ANTIGOS

 
 
    public function voto()
    {
        return $this->belongsTo(Proposition::class, 'proposition_id', 'id');
    }
    
    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id', 'id'); 
    }
}
