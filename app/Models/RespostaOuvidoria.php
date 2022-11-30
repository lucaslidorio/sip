<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespostaOuvidoria extends Model
{
    use HasFactory;

    protected $table = 'resposta_ouvidorias';

    protected $fillable = [
        'ouvidoria_id', 'resposta',   'user_id', 'visualizado',
       
    ];

    public function ouvidoria()
    {
        return $this->belongsTo(Ouvidoria::class, 'ouvidoria_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
