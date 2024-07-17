<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProcessoCompras extends Model
{
    use HasFactory;
    protected $table = 'processo_compras';

    protected $fillable = ['modalidade_id', 'proceeding_situation_id','criterio_julgamento_id',
    'numero', 'objeto', 'descricao', 'data_publicacao', 'inicio_sessao', 'qtd_lotes', 'user_created', 'user_last_updated' ];

    
    
    protected $dates = ['data_publicacao'];
    //força a conversão das datas
    public function getDataPublicacaoAttribute($value)
    {
        return Carbon::parse($value);
    }
    public function getInicioSessaoAttribute($value)
    {
        return Carbon::parse($value);
    }



    public function situacao(){
        return $this->belongsTo(ProceedingSituation::class,'proceeding_situation_id', 'id' );
    }

    public function modalidade(){
        return $this->belongsTo(Modalidades::class,'modalidade_id', 'id' );
    }
    public function criterio_julgamento(){
        return $this->belongsTo(CriterioJulgamento::class, 'criterio_julgamento_id', 'id');
    }
    public function user_create(){
        return $this->belongsTo(User::class,'user_created', 'id' );
    }
    public function user_last_update(){
        return $this->belongsTo(User::class,'user_last_update', 'id' );
    }
    public function anexos(){
        return $this->hasMany(AnexosProcessoCompra::class,'processo_compra_id', 'id');
    }
    public function credenciamentos()
    {
        return $this->hasMany(CredenciamentosProcessosCompras::class, 'processo_compra_id');
    }

    

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['modalidade_id'])) {
            $query->where('modalidade_id', $filters['modalidade_id']);
        }
        if (isset($filters['criterio_julgamento_id'])) {
            $query->where('criterio_julgamento_id', $filters['criterio_julgamento_id']);
        }
        if (isset($filters['proceeding_situation_id'])) {
            $query->where('proceeding_situation_id', $filters['proceeding_situation_id']);
        }
        if (isset($filters['pesquisa'])) {
            $query->where(function ($query) use ($filters) {
                $query->where('objeto', 'like', '%' . $filters['pesquisa'] . '%')
                    ->orWhere('descricao', 'like', '%' . $filters['pesquisa'] . '%');
            });
        }
        return $query;
    }

/**
 * Conte o número de credenciamentos com seus últimos movimentos.
 *
 * @return array
 */
    public function countCredenciamentosWithLastMovements()
        {
            // Obter todos os credenciamentos deste processo com suas movimentações e tipos de movimentações
            $credenciamentos = $this->credenciamentos()->with(['movimentacoes.tipoMovimentacao'])->get();

            // Inicializar o contador
            $counts = [
                'total' => 0,
                'movements' => [],
                'nao_recebido' => 0 // Contador adicional para movimentações sem o tipo 3/ Recebido (Documentação em Analise)
            ];

            foreach ($credenciamentos as $credenciamento) {
                $counts['total']++;

                // Obter todas as movimentações deste credenciamento
                $movements = $credenciamento->movimentacoes;

                // Verificar se não há movimentação do tipo 3
                $hasMovementType3 = $movements->contains(function ($movement) {
                    return $movement->tipoMovimentacao->id == 3;
                });

                if (!$hasMovementType3) {
                    $counts['nao_recebido']++;
                }

                // Obter a última movimentação deste credenciamento
                $lastMovement = $credenciamento->movimentacoes->sortByDesc('created_at')->first();

                if ($lastMovement) {
                    $movementTypeId = $lastMovement->tipoMovimentacao->id;
                    $movementTypeName = $lastMovement->tipoMovimentacao->nome;
                    if (!isset($counts['movements'][$movementTypeId])) {
                        $counts['movements'][$movementTypeId] = [
                            'nome' => $movementTypeName,
                            'count' => 0
                        ];
                    }

                    $counts['movements'][$movementTypeId]['count']++;
                }
            
            }

            return $counts;
        }
}
