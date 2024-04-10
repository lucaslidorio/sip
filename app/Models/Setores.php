<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setores extends Model
{
    use HasFactory;

    protected $fillable = [        
        'secretary_id',
        'nome',
        'situacao',     
    ];

    
    public function secretary(){
        return $this->belongsTo(Secretary::class);
    }
}
