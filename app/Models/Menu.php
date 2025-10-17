<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = [
        'id', 'menu_pai_id', 'categoria_id', 'nome', 'url', 'slug',
        'tipo_menu', 'icone', 'descricao', 'posicao', 'ordem', 'target',
        'pagina_interna', 'cor_destaque', 'ativo', 'configuracao'
    ];

    protected $casts = [
        'target' => 'boolean',
        'pagina_interna' => 'boolean',
        'ativo' => 'boolean',
        'configuracao' => 'array'
    ];

    // Constantes
    const POSICAO = [
        1 => '1 = Menu Principal',
        2 => '2 = Barra Superior',
        3 => '3 = Menu (Acesso)',
    ];

    const TIPOS_MENU = [
        'simples' => 'Link Simples',
        'dropdown' => 'Menu Dropdown',
        'mega_menu' => 'Mega Menu',
        'categoria' => 'Categoria'
    ];

    const TIPOS_MENU_DESCRICAO = [
        'simples' => 'Link direto para uma página',
        'dropdown' => 'Menu com submenu tradicional',
        'mega_menu' => 'Menu expandido com categorias',
        'categoria' => 'Seção dentro de um mega menu'
    ];

    // Relacionamentos Básicos
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'menu_pai_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Menu::class, 'categoria_id');
    }

    // Relacionamentos Hierárquicos
    public function children()
    {
        return $this->hasMany(Menu::class, 'menu_pai_id')
                    ->where('ativo', true)
                    ->orderBy('ordem');
    }

    public function allChildren()
    {
        return $this->hasMany(Menu::class, 'menu_pai_id')
                    ->orderBy('ordem');
    }

    // Relacionamentos para Mega Menu
    public function categorias()
    {
        return $this->hasMany(Menu::class, 'menu_pai_id')
                    ->where('tipo_menu', 'categoria')
                    ->where('ativo', true)
                    ->orderBy('ordem');
    }

    public function itensCategoria()
    {
        return $this->hasMany(Menu::class, 'categoria_id')
                    ->where('tipo_menu', 'simples')
                    ->where('ativo', true)
                    ->orderBy('ordem');
    }

    public function todosItensCategoria()
    {
        return $this->hasMany(Menu::class, 'categoria_id')
                    ->orderBy('ordem');
    }

    // Relacionamentos Legados (Compatibilidade)
    public function submenu()
    {
        return $this->hasMany(Menu::class, 'menu_pai_id', 'id');
    }

    public function submenus()
    {
        return $this->children();
    }

    // Scopes
    public function scopeAtivos(Builder $query)
    {
        return $query->where('ativo', true);
    }

    public function scopeInativos(Builder $query)
    {
        return $query->where('ativo', false);
    }

    public function scopeTipo(Builder $query, $tipo)
    {
        return $query->where('tipo_menu', $tipo);
    }

    public function scopePrincipais(Builder $query)
    {
        return $query->whereNull('menu_pai_id')->where('posicao', 1);
    }

    public function scopePais(Builder $query)
    {
        return $query->whereNull('menu_pai_id');
    }

    public function scopeMegaMenus(Builder $query)
    {
        return $query->where('tipo_menu', 'mega_menu');
    }

    public function scopeCategorias(Builder $query)
    {
        return $query->where('tipo_menu', 'categoria');
    }

    public function scopeSimples(Builder $query)
    {
        return $query->where('tipo_menu', 'simples');
    }

    public function scopeDropdowns(Builder $query)
    {
        return $query->where('tipo_menu', 'dropdown');
    }

    public function scopePosicao(Builder $query, $posicao)
    {
        return $query->where('posicao', $posicao);
    }

    public function scopeOrdenado(Builder $query)
    {
        return $query->orderBy('ordem', 'ASC');
    }

    // Scope de Filtros (Compatibilidade)
    public function scopeFilter(Builder $query, $filters)
    {
        if (isset($filters['menu_pai_id']) && $filters['menu_pai_id'] !== '') {
            $query->where('menu_pai_id', $filters['menu_pai_id']);
        }

        if (isset($filters['posicao']) && $filters['posicao'] !== '') {
            $query->where('posicao', $filters['posicao']);
        }

        if (isset($filters['tipo_menu']) && $filters['tipo_menu'] !== '') {
            $query->where('tipo_menu', $filters['tipo_menu']);
        }

        if (isset($filters['ativo']) && $filters['ativo'] !== '') {
            $query->where('ativo', $filters['ativo']);
        }

        if (isset($filters['pesquisa']) && $filters['pesquisa'] !== '') {
            $query->where(function ($q) use ($filters) {
                $q->where('nome', 'like', '%' . $filters['pesquisa'] . '%')
                    ->orWhere('url', 'like', '%' . $filters['pesquisa'] . '%')
                    ->orWhere('slug', 'like', '%' . $filters['pesquisa'] . '%')
                    ->orWhere('descricao', 'like', '%' . $filters['pesquisa'] . '%');
            });
        }

        return $query->orderBy('ordem', 'ASC');
    }

    // Métodos de Verificação
    public function isMegaMenu()
    {
        return $this->tipo_menu === 'mega_menu';
    }

    public function isDropdown()
    {
        return $this->tipo_menu === 'dropdown';
    }

    public function isCategoria()
    {
        return $this->tipo_menu === 'categoria';
    }

    public function isSimples()
    {
        return $this->tipo_menu === 'simples';
    }

    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }

    public function hasCategories()
    {
        return $this->categorias()->count() > 0;
    }

    public function isActive()
    {
        return $this->ativo;
    }

    public function isPrincipal()
    {
        return is_null($this->menu_pai_id) && $this->posicao == 1;
    }

    // Métodos de Configuração
    public function getConfiguracao($key = null, $default = null)
    {
        if (is_null($key)) {
            return $this->configuracao ?? [];
        }

        return data_get($this->configuracao, $key, $default);
    }

    public function setConfiguracao($key, $value = null)
    {
        $config = $this->configuracao ?? [];
        
        if (is_array($key)) {
            $config = array_merge($config, $key);
        } else {
            data_set($config, $key, $value);
        }
        
        $this->configuracao = $config;
        return $this;
    }

    // Métodos Estáticos
    public static function getMenusByPosition($position)
    {
        return self::where('posicao', $position)
                   ->ativos()
                   ->principais()
                   ->ordenado()
                   ->get();
    }

    public static function getMenusForFrontend($position = 1)
    {
        return self::with(['children.children', 'categorias.itensCategoria'])
                   ->posicao($position)
                   ->principais()
                   ->ativos()
                   ->ordenado()
                   ->get();
    }

    public static function getMegaMenusWithCategories()
    {
        return self::with(['categorias.itensCategoria'])
                   ->megaMenus()
                   ->ativos()
                   ->ordenado()
                   ->get();
    }

    // Métodos Legados (Compatibilidade)
    public function getMenuPai($id = null)
    {
        return $this->where('id', $id)->first('nome');
    }

    // Métodos de Renderização
    public function getIconeHtml()
    {
        if (empty($this->icone)) {
            return '';
        }

        return '<i class="' . $this->icone . '"></i>';
    }

    public function getUrlCompleta()
    {
        if (empty($this->url)) {
            return '#';
        }

        // Se for URL externa
        if (str_starts_with($this->url, 'http')) {
            return $this->url;
        }

        // Se for URL interna
        return url($this->url);
    }

    public function getTargetAttribute($value)
    {
        return $value ? '_blank' : '_self';
    }

    // Métodos de Árvore
    public function getDescendants()
    {
        $descendants = collect();
        
        foreach ($this->children as $child) {
            $descendants->push($child);
            $descendants = $descendants->merge($child->getDescendants());
        }
        
        return $descendants;
    }

    public function getAncestors()
    {
        $ancestors = collect();
        $parent = $this->parent;
        
        while ($parent) {
            $ancestors->prepend($parent);
            $parent = $parent->parent;
        }
        
        return $ancestors;
    }

    public function getLevel()
    {
        return $this->getAncestors()->count();
    }

    // Boot
    protected static function boot()
    {
        parent::boot();

        // Definir ordem automaticamente se não informada
        static::creating(function ($menu) {
            if (is_null($menu->ordem)) {
                $maxOrdem = static::where('menu_pai_id', $menu->menu_pai_id)
                                 ->where('posicao', $menu->posicao)
                                 ->max('ordem');
                $menu->ordem = ($maxOrdem ?? 0) + 1;
            }
        });

        // Limpar cache ao salvar
        static::saved(function ($menu) {
            // Aqui você pode limpar cache de menus se estiver usando
            // Cache::forget('menus_cache');
        });
    }
}

