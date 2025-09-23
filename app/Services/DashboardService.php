<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\ActivityLog;
use Illuminate\Support\Carbon;

class DashboardService
{
  public function getDashboardData(User $user){
    return [
      'posts' =>  $this->getPaginatedPosts($user),
      'activities' => $this->getPaginatedActivities($user),
      'groupedActivities' => $this->getGroupedActivitiesByDate($this->getPaginatedActivities($user)->getCollection()),
      'statistics' => $this->getStatistics($user),
      'followers' => $this->getFollowers($user)
    ];
  }

  private function getPaginatedPosts(User $user)
  {
    return Post::where('user_id', $user->id)->latest()->paginate(10, ['*'], 'postsPage');
  }

  private function getPaginatedActivities(User $user)
  {
    return ActivityLog::where('user_id', $user->id)->latest()->paginate(10, ['*'], 'activitiesPage');
  }

  private function getGroupedActivitiesByDate($activitiesCollection)
  {
    return $activitiesCollection->groupBy(function ($activity) {
      $daysAgo = (int) $activity->created_at->diffInDays(Carbon::now());

      return match (true) {
        $daysAgo === 0 => 'Hoje',
        $daysAgo === 1 => 'Ontem',
        default => "{$daysAgo} dias atrás"
      };
    });
  }

  private function getStatistics(User $user)
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
}