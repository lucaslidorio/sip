<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LesgislatureCouncilors extends Model
{
    use HasFactory;
    protected $table = 'legislature_councilors';
    protected $fillable = ['legislature_id', 'councilor_id','qtd_votos', 'situacao'];


    public function legislature(){
        return $this->belongsTo(Legislature::class, 'legislature_id', 'id');
    
    }
    
    public function councilors(){
        return $this->belongsTo(Councilor::class, 'councilor_id', 'id');
    
    }
}



