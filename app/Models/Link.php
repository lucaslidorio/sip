<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $table =  'links';
    protected $fillable = ['tenant_id', 'nome','descricao', 'url', 'target', 'tipo', 'icone', 'ordem', 'posicao', 'slug'];

    const POSICAO = [       
            1 => 'Esquerda',
            2 => 'Topo',
            3 => 'Direita',
            4 => 'Inferior',
            5 => 'Centro',
    ];
    const TIPO = [       
        1 => 'Banner',
        2 => 'Links',
        3 => 'Serviços Online', 
        4 => 'Acesso Rápido',    
];
        public function scopePorPosicao($query, $posicao)
        {
                return $query->where('posicao', $posicao)->orderBy('ordem');
        }
         public function scopePorTipo($query, int $tipo)
        {
                return $query->where('tipo', $tipo)->orderBy('ordem');
        }

}
