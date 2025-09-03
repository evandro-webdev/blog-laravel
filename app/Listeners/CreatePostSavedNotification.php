<?php

namespace App\Listeners;

use App\Events\PostSaved;
use App\Models\Notification;

class CreatePostSavedNotification
{
  public function handle(PostSaved $event): void
  {
    $post = $event->post;
    $actor = $event->user;

    if ($actor->id === $post->user_id) {
      return;
    }

    $notification = $this->findExistingNotification($post->user, $post);

    if($notification){
      $this->updateExistingNotification($notification, $actor, $post);
    }else{
      $this->createNewNotification($post->user, $post, $actor);
    }
  }

  private function findExistingNotification($author, $post): ?Notification
  {
    return Notification::where('user_id', $author->id)
      ->where('type', 'post_saved')
      ->where('notifiable_type', $post->getMorphClass())
      ->where('notifiable_id', $post->id)
      ->first();
  }

  private function updateExistingNotification(Notification $notification, $actor, $post): void
  {
    $actors = $notification->data['actors'] ?? [];

    if(!in_array($actor->name, $actors)){
      $actors[] = $actor->name;
    }

    $notification->update([
      'data' => [
        'message' => $this->buildMessage($actors, $post->title),
        'actors' => $actors
      ],
      'read_at' => null
    ]);
  }

  private function createNewNotification($author, $post, $actor): void
  {
    $actors = [$actor->name];

    Notification::firstOrCreate(
      [
        'user_id' => $author->id,
        'type' => 'post_saved', 
        'notifiable_type' => $post->getMorphClass(),
        'notifiable_id' => $post->id
      ],
      [
        'actor_id' => $actor->id,
        'data' => [
          'message' => $this->buildMessage($actors, $post->title),
          'actors' => $actors
        ]
      ]
    );
  }

  private function buildMessage(array $actors, string $postTitle): string
  {
    $count = count($actors);
  
    return match($count) {
      1 => "{$actors[0]} salvou seu post: {$postTitle}",
      2 => "{$actors[0]} e {$actors[1]} salvaram seu post: {$postTitle}",
      3 => "{$actors[0]}, {$actors[1]} e {$actors[2]} salvaram seu post: {$postTitle}",
      default => "{$actors[0]}, {$actors[1]} e outros " . ($count - 2) . " salvaram seu post: {$postTitle}"
    };
  }
}
