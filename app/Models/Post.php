<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'secretary_id',
        'titulo',
        'conteudo',
        'img_destaque',
        'data_publicacao',
        'data_expiracao',
    ];

    public function secretary(){
        return $this->belongsTo(Secretary::class);
    }

    public function catergories(){
        return $this->belongsTo(Categoria::class);

    }
}
