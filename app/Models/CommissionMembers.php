<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionMembers extends Model
{
    use HasFactory;

    protected $table = 'commission_member_functions';
    protected $fillble = ['commission_id', 'councilor_id', 'function_id'];    
   



}
