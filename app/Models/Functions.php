<?php

namespace App\Models;

use App\Http\Controllers\Admin\CommissionMemberFunction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Functions extends Model
{
    use HasFactory;
    protected $table = 'functions';
    protected $fillable = ['nome', 'descricao'];


    public function membros()
    {
        return $this->hasMany(CommissionMemberFunction::class, 'function_id');
    }


    public function search($pesquisar =null){

        $resultado = $this      
                    ->where('nome', 'LIKE', )
                    ->orWhere('descricao', 'LIKE', "%{$pesquisar}%")
                    ->paginate(10);
        return $resultado;
    }
}
