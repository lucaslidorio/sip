<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = ['tenant_id', 'menu_pai_id', 'nome', 'url','slug','pagina_interna', 'target',
    'posicao','ordem', 'icone' ];

    const POSICAO = [
        1 => 'Menu Principal',
        2 => 'Barra Superior',
    ];


## Estrutura para os novos sites ###

public function children()
{
    return $this->hasMany(Menu::class, 'menu_pai_id', 'id')->orderBy('ordem');
}

public function parent()
{
    return $this->belongsTo(Menu::class, 'menu_pai_id', 'id');
}

public function hasChildren()
{
    return $this->children()->count() > 0;
}

    
######## fim ########






















    public function getMenuPai($id = null){          
        return $this->where('id', $id)->first('nome'); 
     
    }
    
    public function submenu(){
        return $this->hasMany(Menu::class, 'menu_pai_id', 'id');
    }

    public function scopeFilter(Builder $query, $filters)
    {
        if (isset($filters['menu_pai_id']) && $filters['menu_pai_id'] !== '') {
            $query->where('menu_pai_id', $filters['menu_pai_id']);
        }

        if (isset($filters['posicao']) && $filters['posicao'] !== '') {
            $query->where('posicao', $filters['posicao']);
        }

        if (isset($filters['pesquisa']) && $filters['pesquisa'] !== '') {
            $query->where(function ($q) use ($filters) {
                $q->where('nome', 'like', '%' . $filters['pesquisa'] . '%')
                    ->orWhere('url', 'like', '%' . $filters['pesquisa'] . '%')
                    ->orWhere('slug', 'like', '%' . $filters['pesquisa'] . '%');
            });
        }

        return $query->orderBy('ordem', 'ASC');
    }

    public function scopePais($query)
    {
        return $query->whereNull('menu_pai_id');
    }

    public static function getMenusByPosition($position)
    {
        return self::where('menu_pai_id')
            ->where('posicao', $position)
            ->orderBy('ordem', 'ASC')
            ->get();
    }
}
