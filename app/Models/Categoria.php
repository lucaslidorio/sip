<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'url', 'descricao'];

    // public function posts(){
    //     return $this->belongsTo(Post::class);

    // }
    public function posts(){
        return $this->belongsToMany(Post::class, 'post_category');

    }



    public function search($pesquisar = null)
    {
        //dd($pesquisar);
        $resultado = $this
                    ->where('nome', 'LIKE', "%{$pesquisar}%")
                    ->orWhere('descricao', 'LIKE', "%{$pesquisar}%")
                    ->paginate(10);
                    
        return $resultado;
    }
}

