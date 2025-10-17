<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Session extends Model
{
    use HasFactory;
    protected $table = 'sessions';

    protected $fillable = [
        'user_id', 'nome', 'data', 'hora', 'type_session_id', 'legislature_id',
        'legislature_section_id', 'period_id','descricao', 'link_transmissao'
    ];    

    //Relacionamentos novos
    public function tipo()
    {
        return $this->belongsTo(TypeSession::class, 'type_session_id');
    }

    public function legislatura()
    {
        return $this->belongsTo(Legislature::class, 'legislature_id');
    }

    public function secao()
    {
        return $this->belongsTo(LegislatureSection::class, 'legislature_section_id');
    }

    public function periodo()
    {
        return $this->belongsTo(Period::class, 'period_id');
    }
    
    public function anexos()    {
        return $this->hasMany(AttachmentSession::class, 'session_id');
    }    
      
    public function votos()
    {
        return $this->hasMany(VotoVereadorPropositura::class, 'session_id');
    }

    public function presencas()
    {
        return $this->hasMany(PresentCouncilorSessions::class, 'session_id');
    }
   



    // Relacionamentos antigos
    public function typeSession(){
        return $this->belongsTo(TypeSession::class, 'type_session_id', 'id');
    }
    public function legislature(){
        return $this->belongsTo(Legislature::class, 'legislature_id', 'id');
    }
    public function section(){
        return $this->belongsTo(Section::class,'legislature_section_id', 'id' );
    }
    public function period(){
        return $this->belongsTo(Period::class, 'period_id', 'id');
    }

    public function attachments(){
        return $this->hasMany(AttachmentSession::class);
    }

    public function councilors_present(){
        return $this->belongsToMany(Councilor::class, 'present_councilor_sessions');
    }

 
}
