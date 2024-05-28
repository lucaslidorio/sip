<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriterioJulgamento extends Model
{
    use HasFactory;    
    
    protected $table = 'criterios_julgamento';
    protected $fillable = ['nome', 'descricao'];

}
