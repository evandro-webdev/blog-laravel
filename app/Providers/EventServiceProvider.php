<?php

namespace App\Providers;

use App\Events\CommentAdded;
use App\Events\PostPublished;
use App\Events\UserFollowed;
use App\Listeners\CreateCommentAddedNotification;
use App\Listeners\CreateFollowNotification;
use App\Listeners\CreatePostPublishedNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
  protected $listen = [
    UserFollowed::class => [
      CreateFollowNotification::class,
    ],
    PostPublished::class => [
      CreatePostPublishedNotification::class
    ],
    CommentAdded::class => [
      CreateCommentAddedNotification::class
    ],
  ];
}
