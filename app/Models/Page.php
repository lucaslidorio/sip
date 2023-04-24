<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $fillable = ['tenant_id', 'titulo', 'slug', 'conteudo','anexo'];

    public function attachments(){
        return $this->hasMany(AttachmentPage::class);
    }
   
}
