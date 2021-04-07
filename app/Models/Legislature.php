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
    
    public function sections(){
        return $this->hasMany(Section::class, 'legislature_id');
    }
    

}
