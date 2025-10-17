<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pronunciamento extends Model
{
    use HasFactory;
    protected $fillable = [
        'councilor_id',
        'session_id',
        'discurso',
        'link_video',
    ];
     /**
     * Get the councilor that owns the pronunciamento.
     */
    public function councilor()
    {
        return $this->belongsTo(Councilor::class);
    }

    /**
     * Get the session that the pronunciamento belongs to.
     */
    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}
