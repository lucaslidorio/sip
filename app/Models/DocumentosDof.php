<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DocumentosDof extends Model
{
    use HasFactory;


    protected $table = 'documentos_dof';
    protected $fillable = [
        'user_id',
        'user_id_last_update',
        'tipo_materia_id',
        'sub_tipo_materia_id',
        'titulo',
        'conteudo',
        'uuid',
        'data_publicacao'
    ];

      // Mutator para garantir que a data seja formatada corretamente antes de ser salva no banco
      public function setDataPublicacaoAttribute($value)
      {
          $this->attributes['data_publicacao'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
      }
     // Função de boot para gerar o UUID automaticamente
     protected static function boot()
     {
         parent::boot(); 
         static::creating(function ($model) {
             $model->uuid = (string) Str::uuid();
         });
     }     


    // Relacionamento com o usuário (User)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userLastUpdate()
    {
        return $this->belongsTo(User::class, 'user_id_last_update');
    }

    // Relacionamento com o tipo de matéria (TipoMateria)
    public function tipoMateria()
    {
        return $this->belongsTo(TipoMateria::class, 'tipo_materia_id');
    }

    // Relacionamento com o subtipo de matéria (SubTipoMateria)
    public function subTipoMateria()
    {
        return $this->belongsTo(SubTipoMateria::class, 'sub_tipo_materia_id');
    }

}
