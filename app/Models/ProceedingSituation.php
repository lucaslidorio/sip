<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProceedingSituation extends Model
{
    use HasFactory;

    protected $table = 'proceeding_situation';

    protected $fillable = ['nome', 'descricao', 'processo_compra',];

}
