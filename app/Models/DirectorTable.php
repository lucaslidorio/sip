<?php

namespace App\Models;

use BienniunLegislatures;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DirectorTable extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'director_tables';
    protected $fillable = ['biennium_legislature_id', 'nome', 'objetivo'];

    public function biennium (){
        return $this->belongsTo(BienniunLegislatures::class, 'biennium_legislature_id', 'id');
    }
}
