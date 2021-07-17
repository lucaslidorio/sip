<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentLegislation extends Model
{
    use HasFactory;
    
   
    protected $table = 'attachment_legislations';
    protected $fillable = ['user_id', 'legislation_id', 'type_document_id', 'anexo', 'nome_original'];
    
    public function type_document(){
        return $this->belongsTo(TypeDocument::class, 'type_document_id', 'id');
    }

}
