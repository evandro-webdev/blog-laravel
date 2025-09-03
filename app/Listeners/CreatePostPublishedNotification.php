<?php

namespace App\Listeners;

use App\Events\PostPublished;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatePostPublishedNotification implements ShouldQueue
{
  use InteractsWithQueue;

  public function handle(PostPublished $event): void
  {
    $post = $event->post;
    $author = $event->author;

    $followers = $author->followers;

    foreach($followers as $follower){
      Notification::updateOrCreate(
        [
          'user_id' => $follower->id,
          'notifiable_id' => $post->id,
          'notifiable_type' => get_class($post),
          'type' => 'post_published'
        ],
        [
          'actor_id' => $author->id,
          'data' => [
            'message' => "{$author->name} publicou um novo post: {$post->title}"
          ]
      ]);
    }
  }
}