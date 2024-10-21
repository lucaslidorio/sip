<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoAssinaturas extends Model
{
    use HasFactory;

    protected $fillable = ['documento_dof_id', 'user_id','funcao_id', 'assinatura', 'documento_hash', 'data_assinatura', 'codigo_verificacao'];

     // Garantir que o campo data_assinatura seja tratado como uma instância de Carbon
     protected $casts = [
        'data_assinatura' => 'datetime',
    ];
    public function documento()
    {
        return $this->belongsTo(DocumentosDof::class, 'documento_dof_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //Formata a data para sempre mostrar no formado correto
    // public function getDataAssinaturaAttribute($value)
    // {
    //     return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    // }

    /**
     * Relacionamento com a função do usuário (UsersFunction)
     */
    public function funcao()
    {
        return $this->belongsTo(Functions::class, 'funcao_id');
    }


}
