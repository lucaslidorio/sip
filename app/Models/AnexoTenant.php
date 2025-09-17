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

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenants_id');
    }
}
