<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentSession extends Model
{
    use HasFactory;
    protected $table ='attachment_sessions';

    protected $fillable =['user_id', 'session_id', 'type_document_id', 'anexo', 'nome_original','descricao'];


    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }
    public function type_document()
    {
        return $this->belongsTo(TypeDocument::class, 'type_document_id');
    }
}
