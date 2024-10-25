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

      public function getCreatedAtAttribute($value){
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
      }
      public function getUpdatedAtAttribute($value){
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
      }


     // Função de boot para gerar o UUID automaticamente
     protected static function boot()
     {
         parent::boot(); 
         static::creating(function ($model) {
             $model->uuid = (string) Str::uuid();
             do {
                // Gera o código hash único
                $codigo_verificacao = strtoupper(Str::random(12));
            } while (self::where('codigo_verificacao', $codigo_verificacao)->exists());// Verifica se o código já existe
            $model->codigo_verificacao = $codigo_verificacao;
         });

        parent::boot();

        // Método chamado quando o documento está sendo atualizado
        static::updating(function ($documento) {
            // Recalcular o hash do documento com base nos campos relevantes
            $dadosDocumentoAtual = $documento->user_id_last_update
                . $documento->tipo_materia_id
                . $documento->sub_tipo_materia_id
                . $documento->titulo
                . $documento->uuid
                . $documento->conteudo
                . $documento->user_id;

            $documentoHashAtual = hash('sha256', $dadosDocumentoAtual);
            // Se o hash do documento mudou, significa que houve uma alteração
            if ($documento->hash_documento !== $documentoHashAtual) {
                 // Invalida apenas as assinaturas com status true (válidas)
                $documento->assinaturas()->where('status', true)->update(['status' => false]);
                // Atualiza o hash do documento para refletir o novo estado
                $documento->hash_documento = $documentoHashAtual;
            }
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
    /**
         * Retorna as assinaturas do documento.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
    // Relacionamento um-para-muitos com DocumentoAssinatura    
    public function assinaturas()
    {
        return $this->hasMany(DocumentoAssinaturas::class, 'documento_dof_id');
    }
   
    






}
