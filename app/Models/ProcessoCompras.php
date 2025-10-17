<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProcessoCompras extends Model
{
    use HasFactory;
    protected $table = 'processo_compras';

    protected $fillable = [
        'modalidade_id',
        'proceeding_situation_id',
        'criterio_julgamento_id',
        'numero',
        'objeto',
        'descricao',
        'data_publicacao',
        'data_validade',
        'inicio_sessao',
        'qtd_lotes',
        'user_created',
        'user_last_updated'
    ];

    protected $casts = [
        'data_validade' => 'datetime',
        'data_publicacao' => 'datetime',
        'inicio_sessao' => 'datetime',
        // outros campos de data...
    ];

    protected $dates = [
        'data_publicacao',
        'data_validade',
        'inicio_sessao'
    ];
    //força a conversão das datas
    public function getDataPublicacaoAttribute($value)
    {
        return Carbon::parse($value);
    }
    public function getDataValidadeAttribute($value)
    {
        return Carbon::parse($value);
    }



    public function situacao()
    {
        return $this->belongsTo(ProceedingSituation::class, 'proceeding_situation_id', 'id');
    }

    public function modalidade()
    {
        return $this->belongsTo(Modalidades::class, 'modalidade_id', 'id');
    }
    public function criterio_julgamento()
    {
        return $this->belongsTo(CriterioJulgamento::class, 'criterio_julgamento_id', 'id');
    }

    public function user_create()
    {
        return $this->belongsTo(User::class, 'user_created', 'id');
    }
    public function user_last_update()
    {
        return $this->belongsTo(User::class, 'user_last_update', 'id');
    }
    public function anexos()
    {
        return $this->hasMany(AnexosProcessoCompra::class, 'processo_compra_id', 'id');
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

    /**
     * Obtém apenas os credenciamentos com última movimentação do tipo 5 (credenciado)
     * ordenados por data de credenciamento (crescente)
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */

    public function getCredenciadosValidos()
    {
        // Approach usando Query Builder para performance
        return DB::table('credenciamentos_processos_compras AS cpc')
            ->join('movimentacoes_credenciamentos AS mc', function ($join) {
                $join->on('mc.credenciamento_compra_id', '=', 'cpc.id')
                    // Subconsulta para verificar se é a última movimentação
                    ->whereRaw('mc.id = (
                    SELECT mc2.id 
                    FROM movimentacoes_credenciamentos AS mc2 
                    WHERE mc2.credenciamento_compra_id = cpc.id 
                    ORDER BY mc2.created_at DESC 
                    LIMIT 1
                )');
            })
            ->join('dados_pessoas AS dp', 'dp.id', '=', 'cpc.dado_pessoa_id')
            ->leftJoin('tipos_movimentacoes_credenciamentos AS tm', 'tm.id', '=', 'mc.tipo_movimentacao_id')
            ->where('cpc.processo_compra_id', $this->id)
            ->where('mc.tipo_movimentacao_id', 5) // Apenas tipo 5 (credenciado)
            ->select(
                'dp.id',
                'dp.nome_fantasia',
                'dp.razao_social',
                'dp.cnpj',
                'dp.cidade',
                'dp.estado',
                'mc.created_at as data_credenciamento',
                'tm.nome as situacao_nome',
                'tm.id as situacao_id',
                'cpc.id as credenciamento_id'
            )
            ->orderBy('mc.created_at', 'asc') // Ordem crescente por data de credenciamento
            ->get();
    }

    /**
     * Conta o número de credenciamentos válidos (última movimentação tipo 5)
     *
     * @return int
     */
    public function countCredenciadosValidos()
    {
        return DB::table('credenciamentos_processos_compras AS cpc')
            ->join('movimentacoes_credenciamentos AS mc', function ($join) {
                $join->on('mc.credenciamento_compra_id', '=', 'cpc.id')
                    ->whereRaw('mc.id = (
                    SELECT mc2.id 
                    FROM movimentacoes_credenciamentos AS mc2 
                    WHERE mc2.credenciamento_compra_id = cpc.id 
                    ORDER BY mc2.created_at DESC 
                    LIMIT 1
                )');
            })
            ->where('cpc.processo_compra_id', $this->id)
            ->where('mc.tipo_movimentacao_id', 5) // Apenas tipo 5 (credenciado)
            ->count();
    }
    // Adicione este método ao modelo ProcessoCompras
    public function getSituacaoCorAttribute()
    {
        if (!$this->situacao) {
            return 'secondary';
        }

        $situacaoNome = mb_strtolower($this->situacao->nome);

        // Mapeamento de cores
        $cores = [
            33 => 'primary',   // ID 33: recebendo proposta
            35 => 'success',   // ID 35: homologado
            36 => 'danger',    // Cancelado (assumindo ID 36)
            37 => 'warning',   // Suspenso (assumindo ID 37)
            38 => 'info',      // Adjudicado (assumindo ID 38)
        ];

        // Se tiver o ID mapeado, use-o
        if (isset($cores[$this->situacao_id])) {
            return $cores[$this->situacao_id];
        }

        // Caso contrário, tente por texto
        if (strpos($situacaoNome, 'homolog') !== false) return 'success';
        if (strpos($situacaoNome, 'receb') !== false) return 'primary';
        if (strpos($situacaoNome, 'cancel') !== false) return 'danger';
        if (strpos($situacaoNome, 'suspend') !== false) return 'warning';
        if (strpos($situacaoNome, 'adjudic') !== false) return 'info';
        if (strpos($situacaoNome, 'deserto') !== false) return 'secondary';
        if (strpos($situacaoNome, 'fracass') !== false) return 'dark';

        // Cor padrão
        return 'secondary';
    }
    /**
     * Helper para obter a cor de uma situação por ID
     * Útil para movimentações de credenciamento
     */
    public static function getSituacaoCor($situacaoId)
    {
        // Mapeamento de cores
        $cores = [
            1 => 'secondary', // Solicitação de Credenciamento (Doc. Pendente)
            2 => 'info',      // Solicitação de Credenciamento (Doc. Enviada)
            3 => 'primary',   // Recebido (Documentação em Analise)
            4 => 'warning',   // Solicitação de Complementação
            5 => 'success',   // Credenciado
            6 => 'danger',    // Credenciamento Suspenso
            7 => 'danger',    // Credenciamento Recusado
            8 => 'danger',    // Descredenciado
            9 => 'info',     // Solicitação de Complementação Eviada pelo Credenciado
        ];

        return $cores[$situacaoId] ?? 'secondary';
    }
}
