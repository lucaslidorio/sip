<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProceedingSituation extends Model
{
    use HasFactory;

    protected $table = 'proceeding_situation';

    protected $fillable = ['nome', 'descricao', 'processo_compra',];

    // Adicione este método ao modelo ProceedingSituation
    public function getCorAttribute()
    {
        // Mapeamento de palavras-chave nas situações para classes do Bootstrap
        $mapeamentoCores = [
            'recebendo proposta' => 'primary',
            'homolog' => 'success',    // Match parcial para 'homologado', 'homologação', etc
            'cancel' => 'danger',      // Match parcial para 'cancelado', 'cancelamento', etc
            'suspens' => 'warning',    // Match parcial para 'suspenso', 'suspensão', etc
            'adjudic' => 'info',       // Match parcial para 'adjudicado', 'adjudicação', etc
            'deserto' => 'secondary',
            'fracass' => 'dark',       // Match parcial para 'fracassado'
            'finaliz' => 'dark',       // Match parcial para 'finalizado'
            'revog' => 'danger',       // Match parcial para 'revogado'
        ];

        $nomeMinusculo = mb_strtolower($this->nome);
        
        foreach ($mapeamentoCores as $palavraChave => $cor) {
            if (strpos($nomeMinusculo, $palavraChave) !== false) {
                return $cor;
            }
        }

        // Cor padrão se nenhuma correspondência for encontrada
        return 'secondary';
    }
}
