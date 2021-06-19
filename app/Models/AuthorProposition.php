<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorProposition extends Model
{
    use HasFactory;

    protected $table = "author_propositions";
    protected $fillable =[
        'proposition_id',
        'councilor_id',
    ];
}
