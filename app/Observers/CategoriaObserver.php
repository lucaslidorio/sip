<?php

namespace App\Observers;

use App\Models\Categoria;
use Illuminate\Support\Str;

class CategoriaObserver
{

    //Oberver fica monitorando o Model, antes de cadastrar e atualizar
    //ele pega o nome e transforma para salvar a url
    public function creating(Categoria $categoria)
    {
        //$categoria->url = Str::kebab($categoria->nome)->slug('-');  
        $categoria->url = Str::of($categoria->nome)->slug('-');      
    }

    public function updating(Categoria $categoria)
    {
        $categoria->url = Str::kebab($categoria->nome);
    }

}
