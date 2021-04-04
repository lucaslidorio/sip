<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Party extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'parties';
    protected $fillable = ['nome', 'sigla', 'img'];

    public function search($pesquisar =null){

        $resultado = $this      
                    ->where('nome', 'LIKE', "%{$pesquisar}%")
                    ->orWhere('sigla', $pesquisar)
                    ->paginate(10);
        return $resultado;
    }
}
