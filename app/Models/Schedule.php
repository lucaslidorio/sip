<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedules';
    protected $fillable = ['tenant_id', 'user_id', 'councilor_id', 'title',
                            'description', 'color', 'textColor', 'start', 'end', 'backgroundColor'];

    protected $dates =[
        'start',
        'end'
    ];
                            
}
