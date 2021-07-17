<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legislation extends Model
{
    use HasFactory;
     protected $table = 'legislations';
     protected $fillable = ['type_legislation_id','numero','data', 'caput', 'descricao'];
     
     
         
    public function type_legislations(){
        return $this->belongsTo(TypeLegislation::class, 'type_legislation_id', 'id');
    }

    public function attachments(){
        return $this->hasMany(AttachmentLegislation::class);
    }
    



}


