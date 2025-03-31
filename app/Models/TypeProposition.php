<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProposition extends Model
{
    use HasFactory;

    protected $table = 'type_propositions';
    protected $guarded = [];
    protected $fillable = ['nome', 'descricao',];

    
}
