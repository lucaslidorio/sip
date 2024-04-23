<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Councilor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'councilors';    
    protected $fillable =[
        'party_id',
        'nome',
        'nome_parlamentar',
        'data_nascimento',
        'cpf',
        'estado_civil',
        'naturalidade',
        'ocupacao_profissional',
        'escolaridade',
        'telefone',
        'telefone_gabinete',
        'endereco',
        'endereco_gabinete',
        'email',
        'facebook',
        'instagram',
        'biografia',
        'atual', 
        'img',
    ];

    public function party(){
        return $this->belongsTo(Party::class, 'party_id');
    }

    
    public function minutes(){
        return $this->belongsToMany(Minute::class, 'minute_councilors');

    }
    public function functionTable()
    {
        return $this->BelongsToMany(Functions::class,  'director_table_member_functions', 'councilor_id', 'function_id');
    }
    public function functionCommission()
    {
        return $this->BelongsToMany(Functions::class,  'commission_member_functions', 'councilor_id', 'function_id');
    }
   
    public function votosPropositura()
    {
        return $this->hasMany(VotoVereadorPropositura::class);
    }


    //metodo de pesquisas na index
    public function search($pesquisar = null)    {
        
        $resultado = $this
                    ->where('nome', 'LIKE', "%{$pesquisar}%")
                    ->orWhere('nome_parlamentar', 'LIKE', "%{$pesquisar}%")
                    ->paginate(10);
                    
        return $resultado;
    }
}
