<?php

namespace App\Listeners;

use App\Events\CommentAdded;
use App\Models\Notification;

class CreateCommentAddedNotification
{
  public function handle(CommentAdded $event): void
  {
    $comment = $event->comment;
    $post = $comment->post;
    $author = $post->user;

    if ($author->id === $comment->user_id) {
      return;
    }

    $notification = $this->findExistingNotification($author, $post);

    if($notification){
      $this->updateExistingNotification($notification, $comment);
    }else{
      $this->createNewNotification($author, $post, $comment);
    }
  }

  private function findExistingNotification($author, $post): ?Notification
  {
    return Notification::where('user_id', $author->id)
      ->where('type', 'comment')
      ->where('notifiable_type', $post->getMorphClass())
      ->where('notifiable_id', $post->id)
      ->first();
  }

  private function updateExistingNotification(Notification $notification, $comment): void
  {
    $actors = $notification->data['actors'] ?? [];

    if(!in_array($comment->user->name, $actors)){
      $actors[] = $comment->user->name;
    }

    $notification->update([
      'data' => [
        'message' => $this->buildMessage($actors, $comment->post->title),
        'actors' => $actors
      ],
      'read_at' => null
    ]);
  }

  private function createNewNotification($author, $post, $comment): void
  {
    $actors = [$comment->user->name];

    Notification::firstOrCreate(
      [
        'user_id' => $author->id,
        'type' => 'comment', 
        'notifiable_type' => $post->getMorphClass(),
        'notifiable_id' => $post->id
      ],
      [
        'actor_id' => $comment->user->id,
        'data' => [
          'message' => $this->buildMessage($actors, $comment->post->title),
          'actors' => $actors
        ]
      ]
    );
  }

  private function buildMessage(array $actors, string $postTitle): string
  {
    $count = count($actors);
  
    return match($count) {
      1 => "{$actors[0]} comentou no seu post: {$postTitle}",
      2 => "{$actors[0]} e {$actors[1]} comentaram no seu post: {$postTitle}",
      3 => "{$actors[0]}, {$actors[1]} e {$actors[2]} comentaram no seu post: {$postTitle}",
      default => "{$actors[0]}, {$actors[1]} e outros " . ($count - 2) . " comentaram no seu post: {$postTitle}"
    };
  }
}
