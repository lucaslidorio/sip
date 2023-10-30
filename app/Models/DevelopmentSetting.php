<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevelopmentSetting extends Model
{
    use HasFactory;


    protected $table = 'development_settings';
    protected $fillable = [
        'tenant_id', 'nome_empresa',
        'slogam', 'logo_principal', 'logo_secundario', 'site'
    ];
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id'); 
    }
}
