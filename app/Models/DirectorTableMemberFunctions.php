<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DirectorTableMemberFunctions extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'director_table_member_functions';
    protected $fillable = ['director_table_id', 'councilor_id', 'function_id'];
    
    //Relacinamentos novos

    public function vereador()
    {
        return $this->belongsTo(Councilor::class, 'councilor_id');
    }

    public function funcao()
    {
        return $this->belongsTo(Functions::class, 'function_id');
    }
    //Relacionamentos antigos
    public function functions(){
        return $this->belongsTo(Functions::class, 'function_id', 'id');

    }

    public function directorTable(){
        return $this->belongsTo(DirectorTable::class, 'director_table_id', 'id');
    }
    public function members(){
        return $this->belongsTo(Councilor::class, 'councilor_id', 'id');

    }

}

