<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Functions extends Model
{
    use HasFactory;
    protected $table = 'functions';
    protected $fillable = ['nome', 'descricao'];


    // public function commissions(){
    //     return $this->hasMany(Commission::class, 'commission_members', 'function_id', 'commission_id');
    // }

    public function search($pesquisar =null){

        $resultado = $this      
                    ->where('nome', 'LIKE', )
                    ->orWhere('descricao', 'LIKE', "%{$pesquisar}%")
                    ->paginate(10);
        return $resultado;
    }
}
