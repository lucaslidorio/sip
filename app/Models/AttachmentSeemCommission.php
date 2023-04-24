<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentSeemCommission extends Model
{
    use HasFactory;

    protected $table = 'attachment_seem_commissions';
    protected $fillable = ['user_id', 'commission_id', 'type_document_id', 'anexo', 'nome_original'];
    
    public function type_document(){
        return $this->belongsTo(TypeDocument::class, 'type_document_id', 'id');
    }
}
