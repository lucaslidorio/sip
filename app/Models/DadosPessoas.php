<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DadosPessoas extends Model
{
    use HasFactory;

    protected $table = 'dados_pessoas';
    protected $fillable = [
        'user_id', 
        'tipo_pessoa',
        'natureza_juridica',
        'enquadramento',
        'nome_fantasia',
        'razao_social',
        'cnpj',
        'inscricao_estadual',
        'data_abertura',
        'site',
        'email',
        'cep',
        'endereco',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'telefone',
        'celular',     
    ];

    public function getDataAberturaAttribute($value)
    {
        return Carbon::parse($value);
    }
    public function usuario() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // public function documento_pessoa() {
    //     return $this->hasMany(DocumentosPessoas::class, , 'dado_pessoa_id');
    // }
    public function documentosPessoas()
    {
        return $this->hasMany(DocumentosPessoas::class, 'dado_pessoa_id', 'id');
    }
    public function credenciamentosProcessosCompras()
    {
        return $this->hasMany(CredenciamentosProcessosCompras::class, 'dado_pessoa_id');
    }

     // Função para contar os credenciamentos existentes
     public function countCredenciamentos()
     {
         return $this->credenciamentosProcessosCompras()->count();
     }
 
     // Função para contar os credenciamentos com movimentação do tipo 5 (credenciado)
     public function countCredenciamentosAtivo()
     {
         return $this->credenciamentosProcessosCompras()->whereHas('movimentacoes', function ($query) {
             $query->where('tipo_movimentacao_id', 5);
         })->count();
     }
     public function countDescredenciado()
     {
         return $this->credenciamentosProcessosCompras()->whereHas('movimentacoes', function ($query) {
             $query->where('tipo_movimentacao_id', 8);
         })->count();
     }

}

