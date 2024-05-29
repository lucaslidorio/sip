<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnexosProcessoCompra extends Model
{
    use HasFactory;
    protected $table = 'anexos_processo_compras';
    protected $fillable = ['processo_compra_id', 'type_document_id', 
     'anexo', 'nome', 'descricao', 'qtd_download'];
    
    public function type_document()
    {
        return $this->belongsTo(TypeDocument::class, 'type_document_id');
    }
}
