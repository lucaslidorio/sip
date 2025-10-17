<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegislatureSection extends Model
{
    protected $table = 'legislature_sections';

    protected $fillable = [
        'legislature_id',
        'descricao',
        'ano',
    ];

    // Relacionamento com a legislatura
    public function legislatura()
    {
        return $this->belongsTo(Legislature::class, 'legislature_id');
    }

    // Relacionamento com as sessões
    public function sessoes()
    {
        return $this->hasMany(Session::class, 'legislature_section_id');
    }
}
