<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\ActivityLog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DashboardService
{
  public function getDashboardData(User $user){
    return [
      'posts' =>  $this->getPaginatedPosts($user),
      'activities' => $this->getPaginatedActivities($user),
      'groupedActivities' => $this->getGroupedActivitiesByDate($this->getPaginatedActivities($user)->getCollection()),
      'statistics' => $this->getStatistics($user),
      'followers' => $this->getFollowers($user),
      'mostViewedPosts' => $this->getMostViewedPosts($user),
      'mostCommentedPosts' => $this->getMostCommentedPosts($user)
    ];
  }

  private function getPaginatedPosts(User $user): LengthAwarePaginator
  {
    return Post::where('user_id', $user->id)->latest()->paginate(10, ['*'], 'postsPage');
  }

  private function getPaginatedActivities(User $user)
  {
    return ActivityLog::where('user_id', $user->id)->latest()->paginate(10, ['*'], 'activitiesPage');
  }

  private function getGroupedActivitiesByDate(Collection $activitiesCollection): Collection
  {
    $today = now()->startOfDay();
    $yesterday = $today->copy()->subDay();

    return $activitiesCollection->groupBy(function ($activity) use($today, $yesterday) {
      $activityDate = $activity->created_at->copy()->startOfDay();

      return match (true) {
        $activityDate->equalTo($today) => 'Hoje',
        $activityDate->equalTo($yesterday) => 'Ontem',
        default => $activityDate->diffInDays($today) . ' dias atrás',
      };
    });
  }

  private function getStatistics(User $user): array
  {
    $thirtyDaysAgo = now()->subDays(30);
    $postsIds = $user->posts()->pluck('id');

    return [
      'posts' => [
        'total' => $user->posts()->count(),
        'last_30_days' => $user->posts()->where('created_at', '>=', $thirtyDaysAgo)->count()
      ],
      'views' => [
        'total' => $user->postViews()->count(),
        'last_30_days' => $user->postViews()->where('viewed_at', '>=', $thirtyDaysAgo)->count()
      ],
      'followers' => [
        'total' => $user->followers()->count(),
        'last_30_days' => $user->followers()->where('followers.created_at', '>=', $thirtyDaysAgo)->count()
      ],
      'comments' => [
        'total' => Comment::whereIn('post_id', $postsIds)->count(),
        'last_30_days' => Comment::whereIn('post_id', $postsIds)->where('created_at', '>=', $thirtyDaysAgo)->count()
      ]
    ];
  }

  private function getFollowers(User $user)
  {
    return $user->followers();
  }

  private function getMostViewedPosts(User $user): LengthAwarePaginator
  {
    return $user->posts()->withCount('views')
      ->where('published', true)
      ->orderByDesc('views_count')
      ->paginate(5);
  }

  private function getMostCommentedPosts(User $user): LengthAwarePaginator
  {
    return $user->posts()->withCount('comments')
      ->where('published', true)
      ->orderByDesc('comments_count')
      ->paginate(5);;
  }
}