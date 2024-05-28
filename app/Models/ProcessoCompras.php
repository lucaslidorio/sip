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
  

}
