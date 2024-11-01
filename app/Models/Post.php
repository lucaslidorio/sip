<?php

namespace App\Models;

use Carbon\Carbon;
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
        'destaque',
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

    public function search($pesquisar =null){

        $resultado = $this      
                    ->where('titulo', 'LIKE', )
                    ->orWhere('conteudo', 'LIKE', "%{$pesquisar}%")
                    ->paginate(10);
        return $resultado;
    }
    
    public function noticiasPesquisar($pesquisar)
    {
        $resultado = $this
            ->where(function ($query) use ($pesquisar) {
                $query->where('titulo', 'LIKE', "%{$pesquisar}%"
                )
                ->orWhere('conteudo', 'LIKE', "%{$pesquisar}%");
            })
            ->where(function ($query) {
                $query->whereNull('data_expiracao')
                ->orWhereDate('data_expiracao', '>=', Carbon::now()->format('Y-m-d'));
            })
            ->paginate(10);
        return $resultado;        
    }

    public function noticiaAnterior($id){
        $postAnterior = $id - 1;
        $post = $this->where('id', $postAnterior)
                     ->where('data_expiracao', null)                            
                     ->orWhere('data_expiracao', '>=', Carbon::now()->format('d-m-Y'))                   
                     ->first(); 
        if(!$post){
            $post = $this->where('id', $id)->first('id');
        }        

        return $post;
    }


}
