<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnexosCredenciamentos extends Model
{
    use HasFactory;

    protected $table = 'anexos_credenciamentos';
    protected $fillable = [  'credenciamento_compra_id','type_document_id', 'anexo','nome_original'];
}
