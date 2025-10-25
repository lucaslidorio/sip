<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Tenant extends Model
{
    use HasFactory;
    protected $table = 'tenants';

    protected $fillable = [
    'nome', 
    'slogan',
    'endereco', 
    'numero', 
    'bairro', 
    'cidade', 
    'maps',
    'telefone',
    'celular', 
    'dia_atendimento',
    'cnpj',
    'email', 
    'facebook', 
    'youtube', 
    'instagram',
    'twitter',
    'tiktok', 
    'brasao', 
    'bandeira',
    'favicon',
    'nome_resp_transparencia', 
    'telefone_resp_transparencia',
    'email_resp_transparencia',
    'arquivo_cor_css',
    'template'
    ];

     public function users(){
        return $this->hasMany(User::class);
    }
    
    public function plan(){
        return $this->belongsTo(Plan::class);
    }
    
    public function developmentSettings()
    {
        return $this->belongsTo(DevelopmentSetting::class, 'id', 'tenant_id'); 
    }
    
    public function anexos()
    {
        return $this->hasMany(AnexoTenant::class, 'tenants_id');
    }
    
    /**
     * Retorna os selos de transparência com cache
     */
    public function selosTransparenciaCache()
    {
        return Cache::remember("tenant_{$this->id}_selos", 3600, function () {
            return $this->anexos()
                ->where('tipo_anexo', 1)
                ->where('situacao', 1)
                ->get();
        });
    }
    
    /**
     * Retorna o tenant com selos já carregados (eager loading)
     */
    public static function getCurrentWithSeals()
    {
        return Cache::remember('tenant_current_with_seals', 3600, function () {
            return self::with(['anexos' => function ($query) {
                $query->where('tipo_anexo', 1)
                      ->where('situacao', 1);
            }])->first();
        });
    }
    
    /**
     * Limpa o cache do tenant
     */
    public static function clearCache()
    {
        Cache::forget('tenant_with_seals');
        Cache::forget('tenant_current_with_seals');
        
        // Limpa cache de todos os tenants
        $tenants = self::all();
        foreach ($tenants as $tenant) {
            Cache::forget("tenant_{$tenant->id}_selos");
        }
    }
}
