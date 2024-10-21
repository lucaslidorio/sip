<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserFunction extends Model
{
    use HasFactory;
    protected $table = 'user_functions';
    protected $fillable = [
        'user_id',
        'function_id',
        'data_inicio',
        'data_fim',
        'legislacao',
        'situacao',
    ];
    
    /**
     * Relacionamento com o model User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relacionamento com o model Function
     */
    public function function()
    {
        return $this->belongsTo(Functions::class, 'function_id');
    }
    /**
     * Accessor para retornar o status da situação como string
     */
    public function getSituacaoNomeAttribute()
    {
        return $this->situacao == 1 ? 'Ativo' : 'Inativo';
    }
}
