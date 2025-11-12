<?php

namespace App\Providers;

use App\Models\Comment;
use App\Policies\CommentPolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
      Comment::class => CommentPolicy::class
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      Gate::define('access-admin', fn($user) => $user->role === 'admin');

      Paginator::useTailwind();

      Model::automaticallyEagerLoadRelationships();
      Model::unguard();
    }
}
