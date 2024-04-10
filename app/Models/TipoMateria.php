<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMateria extends Model
{
    use HasFactory;

    protected $table ='tipo_materias';
    protected $fillable = ['id',    'nome'];
}
