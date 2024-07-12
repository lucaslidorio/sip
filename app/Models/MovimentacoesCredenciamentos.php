<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentacoesCredenciamentos extends Model
{
    use HasFactory;
    protected $table = 'movimentacoes_credenciamentos';
    protected $fillable = ['user_id','credenciamento_compra_id', 'tipo_movimentacao_id', 'observacao' ];

    public function credenciamentoProcesso()
    {
        return $this->belongsTo(CredenciamentosProcessosCompras::class, 'credenciamento_compra_id');
    }

    public function tipoMovimentacao()
    {
        return $this->belongsTo(TiposMovimentacoesCredenciamentos::class, 'tipo_movimentacao_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id' );
    }


}
