<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnexoTenant extends Model
{
    protected $table = 'anexos_tenant';
    
    protected $fillable = [
        'tenants_id',
        'anexo',
        'nome_original',
        'tipo_anexo',
        'situacao'
    ];
    const TIPO = [
        1 => 'Selo de Transparência',
        2 => 'Outros',       
    ];

     const SITUACAO = [
        1 => 'Ativo',
        0 => 'Inativo',
    ];
     public function getTipoNomeAttribute()
    {
        return self::TIPO[$this->tipo_anexo] ?? 'Não definido';
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenants_id');
    }
}
