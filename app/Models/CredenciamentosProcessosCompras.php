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
    public function movimentacoes()
    {
        return $this->hasMany(MovimentacoesCredenciamentos::class, 'credenciamento_compra_id');
    }
    
    public function ultimaMovimentacao()
    {
        return $this->hasOne(MovimentacoesCredenciamentos::class, 'credenciamento_compra_id')->latestOfMany();
    }
     // Relacionamento com TiposMovimentacoesCredenciamento através da tabela MovimentacoesCredenciamentos
    public function tiposMovimentacoes()
    {
        return $this->belongsToMany(TiposMovimentacoesCredenciamentos::class, 'movimentacoes_credenciamentos', 'credenciamento_compra_id', 'tipo_movimentacao_id')
                    ->withTimestamps();
    }

    public function documentos()
    {
        return $this->hasMany(AnexosCredenciamentos::class, 'credenciamento_compra_id', 'id');
    }
    public function processo()
    {
        return $this->belongsTo(ProcessoCompras::class, 'processo_compra_id');
    }

    public function dadoPessoa(){
        return $this->belongsTo(DadosPessoas::class, 'dado_pessoa_id', 'id');
    }

    public static function getCredenciamento($dado_pessoa_id, $processo_compra_id)
    {
        return self::where('dado_pessoa_id', $dado_pessoa_id)
                    ->where('processo_compra_id', $processo_compra_id)
                    ->first();
    }







     // Função para obter a última movimentação de um credenciamento específico
     public static function ultimaMovimentacaoCredenciado($processo_compra_id, $dado_pessoa_id)
     {
         // Obter o credenciamento específico
         $credenciamento = self::where('processo_compra_id', $processo_compra_id)
                                ->where('dado_pessoa_id', $dado_pessoa_id)
                                ->first();
 
         // Verificar se o credenciamento foi encontrado
         if ($credenciamento) {
             // Retornar a última movimentação
             return $credenciamento->movimentacoes()->orderBy('created_at', 'desc')->first();
         }
 
         // Retornar nulo se nenhum credenciamento foi encontrado
         return null;
     }

   

}
