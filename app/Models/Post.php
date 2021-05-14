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
        'url',
        'conteudo',
        'img_destaque',
        'data_publicacao',
        'data_expiracao',
    ];

    public function secretary(){
        return $this->belongsTo(Secretary::class);
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function categories(){
        return $this->belongsToMany(Categoria::class, 'post_category');

    }

    public function imagens(){
        return $this->hasMany(PostImg::class);
    }
}
