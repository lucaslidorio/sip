<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Popups extends Model
{
    protected $table='popups';

    protected $fillable = ['nome', 'img', 'url', 'ativo', 'data_expiracao'];


    public function getAtivoTextoAttribute()
    {
        return $this->ativo ? 'Sim' : 'Não';
    }
    
    public function getAtivoBadgeClassAttribute()
    {
        return $this->ativo ? 'success' : 'danger';
    }

    public function search($pesquisar =null){

        $resultado = $this      
                    ->where('nome', 'LIKE', "%{$pesquisar}%")
                    ->orWhere('url', $pesquisar)
                    ->paginate(10);
        return $resultado;
    }
    public function scopeVisiveis($query)
    {
        return $query->where('ativo', true)
                    ->where(function ($q) {
                        $q->whereNull('data_expiracao')
                        ->orWhere('data_expiracao', '>=', now()->toDateString());
                    });
    }


}
