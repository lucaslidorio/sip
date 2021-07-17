<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitizenLetter extends Model
{
    use HasFactory;
    protected $table = 'citizen_letters';
    protected $fillable = ['titulo', 'conteudo'];
}
