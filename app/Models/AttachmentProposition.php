<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentProposition extends Model
{
    use HasFactory;
    protected $table = "attachment_propositions";
    protected $fillable =[
        'user_id',
        'proposition_id',
        'type_document_id',
        'anexo',
        'nome_original',
    ];


    public function type_document(){
        return $this->belongsTo(TypeDocument::class, 'type_document_id', 'id');
    }
}
