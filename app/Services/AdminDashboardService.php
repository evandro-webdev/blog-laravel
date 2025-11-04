<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\PostView;
use App\Models\Tag;
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

  public function getCategoriesData()
  {
    $mostUsedCategories = Category::withCount('posts')
      ->orderByDesc('posts_count')
      ->take(5)
      ->get(['name', 'posts_count']);

    $mostViewedCategories = Category::withCount('views')
      ->orderByDesc('views_count')
      ->take(5)
      ->get(['name', 'views_count']);

    return [
      'categories' => Category::paginate(10),
      'mostUsed' => [
        'names' => $mostUsedCategories->pluck('name'),
        'count' => $mostUsedCategories->pluck('posts_count')
      ],
      'mostViewed' => [
        'names' => $mostViewedCategories->pluck('name'),
        'viewed' => $mostViewedCategories->pluck('views_count'),
      ]
    ];
  }

  public function getTagsData()
  {
    $mostUsedTags = Tag::withCount('posts')
      ->orderByDesc('posts_count')
      ->take(5)
      ->get(['name', 'posts_count']);

    $mostViewedTags = Tag::mostViewed();

    return [
      'tags' => Tag::paginate(10),
      'mostUsed' => [
        'names' => $mostUsedTags->pluck('name'),
        'count' => $mostUsedTags->pluck('posts_count')
      ],
      'mostViewed' => [
        'names' => $mostViewedTags->pluck('name'),
        'viewed' => $mostViewedTags->pluck('views_count'),
      ]
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