<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinuteCouncilor extends Model
{
    use HasFactory;

    protected $table = 'minute_councilors';

    protected $fillable = ['minute_id', 'councilor_id', 'situacao' ];


}
