<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Section;

class Legislature extends Model
{
    use HasFactory;
    use SoftDeletes;

    
    protected $fillable =['id','descricao', 'ordem', 'atual'];
    protected $table = 'legislatures';  
    

    //Relacionamentos novos

    public function vereadores(){
        return $this->belongsToMany(Councilor::class, 'legislature_councilors');
    }


    // Relacinamtentos antigos
    public function sections(){
        return $this->hasMany(Section::class, 'legislature_id');
    }
    public function bienniuns(){
        return $this->hasMany(Biennium::class, 'legislature_id');
    }
    
    public function councilors(){
        return $this->belongsToMany(Councilor::class, 'legislature_councilors');
    }

}
