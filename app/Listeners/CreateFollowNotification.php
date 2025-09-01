<?php

namespace App\Listeners;

use App\Events\UserFollowed;
use App\Models\Notification;

class CreateFollowNotification
{
  public function handle(UserFollowed $event): void
  {
    Notification::updateOrCreate(
    [
      'user_id' => $event->followed->id,
      'actor_id' => $event->follower->id,
      'type' => 'follow',
    ],
    [
      'notifiable_type' => get_class($event->follower),
      'notifiable_id' => $event->follower->id,
      'data' => [
        'message' => "{$event->follower->name} começou a seguir você."
      ]
    ]);
  }
}
