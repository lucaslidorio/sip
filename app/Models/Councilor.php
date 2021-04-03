<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Councilor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'councilors';    
    protected $fillable =[
        'party_id',
        'nome',
        'nome_parlamentar',
        'data_nascimento',
        'cpf',
        'estado_civil',
        'naturalidade',
        'ocupacao_profissional',
        'escolaridade',
        'telefone',
        'telefone_gabinete',
        'endereco',
        'endereco_gabinete',
        'email',
        'facebook',
        'instagram',
        'biografia', 
    ];

    public function party(){
        return $this->belongsTo(Party::class, 'party_id');
    }
}
