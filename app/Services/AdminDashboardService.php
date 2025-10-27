<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\PostView;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AdminDashboardService
{
  public function getOverviewData()
  {
    return [
      'statistics' => $this->getStatistics(),
      'mostViewedPosts' => $this->getMostViewedPosts(),
      'mostCommentedPosts' => $this->getMostCommentedPosts()
    ];
  }

  private function getStatistics(): array
  {
    $thirtyDaysAgo = now()->subDays(30);

    return [
      'posts' => [
        'total' => Post::all()->count(),
        'last_30_days' => Post::where('created_at', '>=', $thirtyDaysAgo)->count()
      ],
      'views' => [
        'total' => PostView::all()->count(),
        'last_30_days' => PostView::where('created_at', '>=', $thirtyDaysAgo)->count()
      ],
      'users' => [
        'total' => User::all()->count(),
        'last_30_days' => User::where('created_at', '>=', $thirtyDaysAgo)->count()
      ],
      'comments' => [
        'total' => Comment::all()->count(),
        'last_30_days' => Comment::where('created_at', '>=', $thirtyDaysAgo)->count()
      ]
    ];
  }

  private function getMostViewedPosts(): LengthAwarePaginator
  {
    return Post::all()->withCount('views')
      ->orderByDesc('views_count')
      ->paginate(5);
  }

  private function getMostCommentedPosts(): LengthAwarePaginator
  {
    return Post::all()->posts()->withCount('comments')
      ->orderByDesc('comments_count')
      ->paginate(5);;
  }

  private function getUsers()
  {
    return User::latest()->paginate(10);
  }
}