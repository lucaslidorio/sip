<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $table = 'periods';
    protected $fillable =['id', 'nome',];

    public function section()
    {
        return $this->belongsTo(Period::class, 'legislature_section_id');
    }
    
}
