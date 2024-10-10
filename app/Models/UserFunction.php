<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserFunction extends Model
{
    use HasFactory;
    protected $table = 'user_functions';
    protected $fillable = [
        'user_id',
        'function_id',
        'data_inicio',
        'data_fim',
        'situacao',        
    ];


     // Mutator para garantir que a data seja formatada corretamente antes de ser salva no banco
     public function setDataInicioAttribute($value)
     {
         $this->attributes['data_inicio'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
     }
     public function setDataIFimAttribute($value)
     {
         $this->attributes['data_fim'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
     }
}
