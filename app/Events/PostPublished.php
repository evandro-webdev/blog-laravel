<?php

namespace App\Events;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostPublished
{
    use Dispatchable, SerializesModels;

    public Post $post;
    public ?User $author;

    public function __construct(Post $post)
    {
      $this->post = $post->withoutRelations();
      $this->author = $post->user;
    }
}
