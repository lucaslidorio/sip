<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosPessoas extends Model
{
    use HasFactory;
    protected $table = 'documentos_pessoas';
    protected $fillable = [
            'user_id',
            'dado_pessoa_id',
            'type_document_id',
            'anexo',
            'nome_original',
            'data_validade'

    ];

    public function usuario() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function dados_pessoa() {
        return $this->belongsTo(DadosPessoas::class, 'dado_pessoa_id', 'id');
    }


}
