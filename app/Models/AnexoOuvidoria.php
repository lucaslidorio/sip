<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnexoOuvidoria extends Model
{
    use HasFactory;
    protected $table = 'anexos_ouvidoria';

    protected $fillable = ['ouvidoria_id', 'anexo', 'nome_original'];

    public function ouvidoria()
    {
        return $this->belongsTo(Ouvidoria::class, 'ouvidoria_id');
    }
}
