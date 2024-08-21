<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquete extends Model
{
    use HasFactory;

    protected $table = 'enquetes';
    protected $fillable = ['user_id','nome','situacao'];

    /**
     * Relacionamento One-to-Many com o modelo ItemEnquete.
     */
    public function itens()
    {
        return $this->hasMany(ItemEnquete::class, 'enquete_id');
    }


    /**
     * Relacionamento Many-to-One com o modelo User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
    


