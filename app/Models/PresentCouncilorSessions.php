<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresentCouncilorSessions extends Model
{
    use HasFactory;
    protected $table ='present_councilor_sessions';
    protected $fillable = ['session_id', 'councilor_id', 'situacao'];
    
}
