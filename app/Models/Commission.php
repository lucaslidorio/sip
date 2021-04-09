<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commission extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =['id','nome', 'objetivo', 'tipo'];
    protected $table = 'commissions'; 
    
    
    // //relaciona os membros da comissão (Councilors - vereadores)
    // public function members(){
    //     return $this->belongsToMany(Councilor::class, 'commission_members' );

    // }
    //  //relaciona os função com comissão
    //  public function functions(){
    //     return $this->belongsToMany(Functions::class, 'commission_members', 'commission_id', 'function_id');

    // }
    





    

    public function search($pesquisar =null){

        $resultado = $this      
                    ->where('nome', 'LIKE', )
                    ->orWhere('objetivo', 'LIKE', "%{$pesquisar}%")
                    ->paginate(10);
        return $resultado;
    }
}
