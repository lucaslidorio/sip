<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentPage extends Model
{
    use HasFactory;
    protected $table = 'attachments_pages';
    protected $fillable = ['user_id', 'page_id', 'type_document_id', 'anexo', 'nome_original'];
    
    public function type_document(){
        return $this->belongsTo(TypeDocument::class, 'type_document_id', 'id');
    }

}
