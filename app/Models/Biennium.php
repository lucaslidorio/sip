<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biennium extends Model
{
    use HasFactory;

    protected $table = 'biennium_legislatures';
    protected $fillable = ['legislaturer_id', 'descricao',
                            'data_inicio', 'data_fim'];

    public function legislature()
    {
        return $this->belongsTo(Legislature::class, 'legislature_id');
    }                        

}
