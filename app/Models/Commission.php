<?php

namespace App\Models;

use App\Http\Controllers\Admin\CommissionMemberFunction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commission extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =['id','nome', 'objetivo', 'tipo'];
    protected $table = 'commissions'; 
    
    //Relacionammentos novos
    public function membros()
        {
            return $this->hasMany(CommissionMembers::class, 'commission_id');
        }

        public function proposicoes()
        {
            return $this->hasMany(SeemCommission::class, 'commission_id');
        }




    //relaciona os membros da comissão (Councilors - vereadores)
    public function members()
    {
        return $this->BelongsToMany(Councilor::class,  'commission_member_functions');
    }
    // public function membros() //novo gpt
    // {
    //     return $this->belongsToMany(Councilor::class, 'commission_member_functions', 'commission_id', 'councilor_id')
    //         ->withPivot('function_id')
    //         ->withTimestamps();
    // }
   

    public function getTipoTextoAttribute()
{
    return match($this->tipo) {
        1 => 'Permanente',
        2 => 'Temporária',
        default => 'Desconhecido',
    };
}
    

    public function search($pesquisar =null){

        $resultado = $this      
                    ->where('nome', 'LIKE', )
                    ->orWhere('objetivo', 'LIKE', "%{$pesquisar}%")
                    ->paginate(10);
        return $resultado;
    }
}
