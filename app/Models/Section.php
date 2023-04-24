<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Legislature;
use App\Models\Period;

class Section extends Model
{
    use HasFactory;

    protected $table = 'legislature_sections';


    //relacionamento entre a muito para um entre a tabela legislature_sections e legislature
    public function legislature()
    {
        return $this->belongsTo(Legislature::class, 'legislature_id');
    }
    //relacionamento de 1 para muitos entre legislature_sections e legislative_perios
    public function periods(){
        return $this->hasMany(LegislativePeriod::class, 'legislature_section_id');
    }
}
