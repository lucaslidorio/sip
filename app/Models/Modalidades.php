<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modalidades extends Model
{
    use HasFactory;
    protected $table = 'modalidades';

    protected $fillable = ['nome', 'descricao',  ];
}
