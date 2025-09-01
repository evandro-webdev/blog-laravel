<?php

namespace App\Providers;

use App\Events\UserFollowed;
use App\Listeners\CreateFollowNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
      UserFollowed::class => [
        CreateFollowNotification::class,
      ],
    ];
}
