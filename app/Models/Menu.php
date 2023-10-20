<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = ['tenant_id', 'menu_pai_id', 'nome', 'url','slug','pagina_interna', 'target',
    'posicao', 'icone' ];

    const POSICAO = [
        1 => 'Esquerda',
        2 => 'Barra Superior',
    ];


    public function getMenuPai($id = null){          
        return $this->where('id', $id)->first('nome'); 
     
    }
    public function submenu(){
        return $this->hasMany(Menu::class, 'menu_pai_id', 'id');
    }

}
