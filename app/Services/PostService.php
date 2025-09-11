<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class PostService 
{
  public function getFeed(?User $user, string $sort = 'recent', int $perPage = 10): LengthAwarePaginator
  {
    $query = Post::query()
      ->where('published', true);

    if($user){
      $query->whereIn('user_id', $user->following()->pluck('user_id'));
    }

    $this->applySorting($query, $sort);

    return $query->paginate($perPage);
  }

  private function applySorting($query, string $sort){
    switch ($sort){
      case 'popular' :
        $query->orderByDesc('views');
        break;

      case 'commented':
        $query->withCount('comments')
              ->orderByDesc('comments_count');
        break;

        case 'saved':
        $query->withCount('savedBy')
              ->orderByDesc('saved_by_count');
        break;

      case 'trending':
        $query->whereBetween('created_at', Carbon::now()->subDays(7), now())
              ->orderByDesc('views');
        break;

      case 'recent':
      default:
        $query->latest();
        break;
    }
  }

  public function getRecentPostsFromFollowing($user){
    return Post::latest()
      ->whereIn('user_id', $user->following()->pluck('user_id'))
      ->take(6)
      ->get();
  }

  public function getTrendingPosts($limit){
    return Post::query()
      ->where('published', true)
      ->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
      ->orderByDesc('views')
      ->take($limit)
      ->get();
  }

  public function getRelatedPosts(Post $post, int $limit = 3){
    return Post::query()
      ->where(function($query) use ($post) {
        $query->whereHas('tags', function($q) use ($post) {
          $q->whereIn('tags.id', $post->tags->pluck('id'));
        })
        ->orWhere('category_id', $post->category_id);
      })
      ->where('id', '!=', $post->id)
      ->where('published', true)
      ->latest()
      ->take($limit)
      ->get();
  }
}