<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DirectorTable extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'director_tables';
    protected $fillable = ['biennium_legislature_id', 'nome', 'atual', 'objetivo'];

    // Relacionamentos novos   

    public function bienio()
    {
        return $this->belongsTo(Biennium::class, 'biennium_legislature_id');
    }
    
    public function membros()
    {
        return $this->hasMany(DirectorTableMemberFunctions::class, 'director_table_id');
    }





   // relacionamentos antigos

    public function biennium (){
        return $this->belongsTo(Biennium::class, 'biennium_legislature_id', 'id');
    }
    //relacionamento com os membros da mesa diretora
    public function members()
    {
        return $this->BelongsToMany(Councilor::class,  'director_table_member_functions');
    }
   
   

    public function search($pesquisar =null){

        $resultado = $this      
                    ->where('nome', 'LIKE', )
                    ->orWhere('objetivo', 'LIKE', "%{$pesquisar}%")
                    ->paginate(10);
        return $resultado;
    }
}
