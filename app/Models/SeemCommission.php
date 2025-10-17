<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeemCommission extends Model
{
    use HasFactory;

    protected $table = 'seem_commissions';
    
    protected $fillable = ['commission_id', 'proposition_id', 'data', 'autoria','assunto', 'descricao'];
     
   

    
    public function commission(){
        return $this->belongsTo(Commission::class, 'commission_id', 'id');
    }
    public function proposition(){
        return $this->belongsTo(Proposition::class, 'proposition_id', 'id');
    }

    public function attachments(){
        return $this->hasMany(AttachmentSeemCommission::class);
    }
}

