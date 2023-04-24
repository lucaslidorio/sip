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
        'url',
        'nome_responsavel',
        'telefone',
        'celular',
        'endereco',
        'email',
        'situacao',
        'sobre',
        ];


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
