<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secretary extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'sigla',
        'slogan',           // novo
        'url',
        'nome_responsavel',
        'img_secretario',
        'icone',            // novo
        'sobre_secretario',
        'telefone',
        'celular',
        'endereco',
        'email',
        'situacao',
        'sobre',
        'cor_destaque',     // novo
        ];

        public function noticias()
            {
                return $this->hasMany(Post::class, 'secretary_id');
            }
        //Faz a pesquisa na index
        public function search($pesquisar = null)
        {
            //dd($pesquisar);
            $resultado = $this
                        ->where('nome', 'LIKE', "%{$pesquisar}%")
                        ->orWhere('sigla', $pesquisar)
                        ->paginate(10);
                        
            return $resultado;
        }
}
