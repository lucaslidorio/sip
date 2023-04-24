<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Minute extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'minutes';
    protected $fillable = ['nome', 'descricao','user_id','type_minute_id','legislature_id',
    'legislature_section_id', 'legislative_period_id'];

    //Relacionamento com tipo de Atas
    public function type(){
        return $this->belongsTo(TypeMinutes::class, 'type_minute_id', 'id');
    }
    //Relacionamento com a lesgislatura
    public function legislature(){
        return $this->belongsTo(Legislature::class, 'legislature_id', 'id');
    }
     //Relacionamento com a Sessão Legislativa
     public function section(){
        return $this->belongsTo(Section::class,'legislature_section_id', 'id' );
    }
    //Relacionamento com periodo legislativo
    public function period(){
        return $this->belongsTo(Period::class, 'legislative_period_id', 'id');
    }

    public function councilors(){
        return $this->belongsToMany(Councilor::class, 'minute_councilors');

    }

    public function attachments(){
        return $this->hasMany(AttachmentMinute::class);
    }





     //metodo de pesquisas na index
     public function search($pesquisar = null)    {
        
        $resultado = $this
                    ->where('nome', 'LIKE', "%{$pesquisar}%")
                    ->orWhere('descricao', 'LIKE', "%{$pesquisar}%")
                    ->paginate(10);
                    
        return $resultado;
    }
}

                        
                       
