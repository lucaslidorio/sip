<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Str;
class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function creating(Post $post)
    {
        $post->url = Str::slug($post->titulo);
    }

    /**
     * Handle the Post "updated" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function updating(Post $post)
    {
        $post->url = Str::slug($post->titulo);
    }

}
