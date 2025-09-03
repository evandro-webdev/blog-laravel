<?php

namespace App\Events;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostSaved
{
    use Dispatchable, SerializesModels;

    public Post $post;
    public User $user;

    public function __construct(Post $post, User $user)
    {
      $this->post = $post;
      $this->user = $user;
    }
}
