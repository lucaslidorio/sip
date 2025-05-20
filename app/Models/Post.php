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
    
        public function noticiasPesquisar($dados)
    {
       
        $query = $this->query();

        // Filtro de título e conteúdo
        if (!empty($dados['pesquisar'])) {
            $query->where(function ($subQuery) use ($dados) {
                $subQuery->where('titulo', 'LIKE', "%" . $dados['pesquisar'] . "%")
                    ->orWhere('conteudo', 'LIKE', "%" . $dados['pesquisar'] . "%");
            });
        }

        // Filtro por categoria (vinculado pela relação)
        if (!empty($dados['category_id'])) {
            $query->whereHas('categories', function ($subQuery) use ($dados) {
                $subQuery->where('categorias.id', $dados['category_id']);
            });
        }

        // Filtro por data de publicação inicial
        if (!empty($dados['data_publicacao_inicial'])) {
            $query->whereDate('data_publicacao', '>=', $dados['data_publicacao_inicial']);
        }

        // Filtro por data de publicação final
        if (!empty($dados['data_publicacao_final'])) {
            $query->whereDate('data_publicacao', '<=', $dados['data_publicacao_final']);
        }

        // Filtro para data de expiração (ativa ou não expirada)
        $query->where(function ($subQuery) {
            $subQuery->whereNull('data_expiracao')
                ->orWhereDate('data_expiracao', '>=', Carbon::now()->format('Y-m-d'));
        });

        // Ordenação e paginação
        return $query->orderBy('data_publicacao', 'desc')->paginate(10);
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
