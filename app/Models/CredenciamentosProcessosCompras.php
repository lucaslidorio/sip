<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CredenciamentosProcessosCompras extends Model
{
    use HasFactory;

    protected $table = 'credenciamentos_processos_compras';
    protected $fillable = [
        'id',
        'dado_pessoa_id',
        'user_id',
        'processo_compra_id'
    ];
    
    // Definindo a relação com MovimentacoesCredenciamentos
    // public function movimentacoes()
    // {
    //     return $this->hasMany(MovimentacoesCredenciamentos::class, 'credenciamento_processo_compra_id');
    // }
     // Relacionamento com TiposMovimentacoesCredenciamento através da tabela MovimentacoesCredenciamentos
    public function tiposMovimentacoes()
    {
        return $this->belongsToMany(TiposMovimentacoesCredenciamentos::class, 'movimentacoes_credenciamentos', 'credenciamento_compra_id', 'tipo_movimentacao_id')
                    ->withTimestamps();
    }

    public function ultimaMovimentacao()
    {
        return $this->hasOne(MovimentacoesCredenciamentos::class, 'credenciamento_compra_id')->latestOfMany();
    }

    public function documentos()
    {
        return $this->hasMany(AnexosCredenciamentos::class, 'credenciamento_compra_id', 'id');
    }

}
