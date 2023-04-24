<?php

namespace App\Models;

use App\Http\Controllers\Admin\PostController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImg extends Model
{
    use HasFactory;

    protected $fillable = ['id_post', 'img'];
    protected $table = 'post_img';


    public function post()
    {
        return $this->belongsTo(PostController::class, 'post_id');
    }
}
