<?php

namespace App\Models;

use App\Http\Controllers\Admin\MinuteController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentMinute extends Model
{
    use HasFactory;
    protected $table = 'attachment_minutes';
    protected $fillable =['minute_id', 'anexo', 'nome_original'];

    public function minute()
    {
        return $this->belongsTo(MinuteController::class, 'minute_id');
    }
}
