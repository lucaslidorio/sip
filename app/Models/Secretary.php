<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post; // import do relacionamento

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
        public function search(?string $pesquisar = null)
        {
            $query = self::query()->where('situacao', 1);

            $pesquisar = trim((string) $pesquisar);
            if ($pesquisar !== '') {
                $like = "%{$pesquisar}%";
                $query->where(function ($q) use ($like) {
                    $q->where('nome', 'like', $like)
                      ->orWhere('sigla', 'like', $like)
                      ->orWhere('slogan', 'like', $like);
                });
            }

            return $query->orderBy('nome')->paginate(10);
        }
}
