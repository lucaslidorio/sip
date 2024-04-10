<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTipoMateria extends Model
{
    use HasFactory;
    protected $table = 'sub_tipo_materias';
    protected $fillable = ['tipo_materia_id','nome', 'situacao'];
    

    public function tipo(){
        return $this->belongsTo(TipoMateria::class, 'tipo_materia_id', 'id');        
    }
}
