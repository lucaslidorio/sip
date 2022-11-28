<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ouvidoria extends Model
{
    use HasFactory;
    protected $table = 'ouvidorias';

    protected $fillable = [
        'tipo_id',  'perfil_ouvidoria_id',   'assunto_ouvidoria_id',
        'orgao_ouvidoria_id', 'anonimo', 'sigiloso','nome','cpf',
        'email', 'telefone', 'celular', 'endereco', 'numero_endereco',
        'bairro', 'municipio', 'uf','cep', 'complemento', 'genero',
        'idade','quant_filhos', 'ocupacao', 'manifestacao', 'codigo'        
    ];

    const ESTADO_CIVIL = [
        0 => 'Não informado',
        1 => ' Solteiro(a)',
        2 => 'Casado(a)',
        3 => 'Divorciado(a) ou Separado(a)',
        4 => 'União Estável',
        5 => 'Viúvo(a)',
    ];
    const OCUPACAO = [
        0 => 'Não informado',
        1 => 'Trabalha no setor público',
        2 => 'Trabalha no setor privado',
        3 => 'Trabalha no setor informal',
        4 => 'Do lar',
        5 => 'Desempregado',
        6 => 'Aposentado',
        7 => 'Outros',
    ];



    public function tipo_ouvidoria(){
        return $this->belongsTo(TipoOvidoria::class, 'tipo_id', 'id');
    }
    public function perfil_ouvidoria(){
        return $this->belongsTo(TipoOvidoria::class, 'perfil_ouvidoria_id', 'id');
    }
    public function assunto_ouvidoria(){
        return $this->belongsTo(TipoOvidoria::class, 'assunto_ouvidoria_id', 'id');
    }
    public function orgao_ouvidoria(){
        return $this->belongsTo(TipoOvidoria::class, 'orgao_ouvidoria_id', 'id');
    }
    
    public function anexos(){
        return $this->hasMany(AnexoOuvidoria::class, 'id', 'ouvidoria_id');
    }
}
