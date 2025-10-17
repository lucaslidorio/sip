<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionMembers extends Model
{
    use HasFactory;

    protected $table = 'commission_member_functions';
    protected $fillable = ['commission_id', 'councilor_id', 'function_id'];    
   
    // Relacionamento novos
    public function vereador()
    {
        return $this->belongsTo(Councilor::class, 'councilor_id');
    }

    public function funcao()
    {
        return $this->belongsTo(Functions::class, 'function_id');
    }



    // Relacionamentos antigos
    public function functions(){
        return $this->belongsTo(Functions::class, 'function_id', 'id');

    }

    public function commission(){
        return $this->belongsTo(Commission::class, 'commission_id', 'id');

    }
    public function members(){
        return $this->belongsTo(Councilor::class, 'councilor_id', 'id');

    }
    

  


}
