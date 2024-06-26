<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposMovimentacoesCredenciamentos extends Model
{
    use HasFactory;
    protected $table = 'tipos_movimentacoes_credenciamentos';
    protected $fillable = ['id', 'nome'];

     // Relacionamento com CredenciamentosProcessosCompras através da tabela MovimentacoesCredenciamentos
     public function credenciamentosProcessos()
     {
         return $this->belongsToMany(CredenciamentosProcessosCompras::class, 'movimentacoes_credenciamentos', 'tipo_movimentacao_id', 'credenciamento_compra_id')
                     ->withTimestamps();
     }
    
}
