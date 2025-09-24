<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PostService 
{
  public function getFeed(?User $user, ?string $sort = null, string $tab, int $perPage = 10): LengthAwarePaginator
  {
    $query = Post::query()->where('published', true);

    if($tab === 'personal-feed' && $user){
      $query->whereIn('user_id', $user->following()->pluck('user_id'));
    }

    $sort = $this->resolveSort($sort, $tab);
    $this->applySorting($query, $sort);

    return $query->paginate($perPage);
  }

  private function resolveSort(?string $sort, string $tab): string
  {
    if($sort) return $sort;
    return $tab === 'trending-feed' ? 'popular' : 'recent';
  }

  private function applySorting($query, string $sort)
  {
    switch ($sort){
      case 'popular' :
        $query->withCount(['views' => function ($q) {
            $q->where('viewed_at', '>=', now()->subDays(7));
          }])
          ->orderByDesc('views_count');
        break;

      case 'commented':
        $query->withCount('comments')
          ->orderByDesc('comments_count');
        break;

      case 'recent':
      default:
        $query->latest();
        break;
    }
  }

  public function getTrendingPostsInPeriod(int $days, int $limit = 5)
  {
    return Post::query()
      ->withCount(['views' => function ($query) use ($days) {
        $query->where('viewed_at', '>=', now()->subDays($days));
      }])
      ->where('published', true)
      ->orderByDesc('views_count')
      ->limit($limit)
      ->get();
  }

  public function getRelatedPosts(Post $post, int $limit = 3): Collection
  {
    return Post::query()
      ->where(function($query) use ($post) {
        $query->orWhereHas('tags', function($q) use ($post) {
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