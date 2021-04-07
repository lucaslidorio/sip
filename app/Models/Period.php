<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $table = 'legislative_periods';
    protected $fillable =['id', 'legislature_section_id', 'descricao','ano'];

    public function section()
    {
        return $this->belongsTo(Period::class, 'legislature_section_id');
    }
}
