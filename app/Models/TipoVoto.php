<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVoto extends Model
{
    use HasFactory;
    protected $table ='tipo_votos';
    protected $fillable = ['id',    'nome'];

    public function votosPropositura()
    {
        return $this->hasMany(VotoVereadorPropositura::class);
    }
}
