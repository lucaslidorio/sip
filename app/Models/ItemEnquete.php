<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemEnquete extends Model
{
    use HasFactory;
    protected $table = 'itens_enquete';

    protected $fillable = [
        'enquete_id',
        'nome',
        'votos',
    ];

    public function enquete()
    {
        return $this->belongsTo(Enquete::class, 'enquete_id');
    }
}
