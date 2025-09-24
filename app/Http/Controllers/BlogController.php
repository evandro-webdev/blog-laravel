<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
  protected PostService $postService;

  public function __construct(PostService $postService)
  {
    $this->postService = $postService;
  }

  public function index(Request $request)
  {
    $user = Auth::user();
    $tab = $request->query('tab', $user ? 'personal-feed' : 'trending-feed');
    $sort = $request->query('sort');

    $posts = $this->postService->getFeed($user, $sort, $tab);
    $trendingPostsThisMonth = $this->postService->getTrendingPostsInPeriod(30);

    $usersToFollow = $this->getUsersToFollow($user);

    return view('home.index', [
      'user' => $user,
      'posts' => $posts,
      'trendingPostsThisMonth' => $trendingPostsThisMonth,
      'sort' => $sort,
      'tab' => $tab,
      'usersToFollow' => $usersToFollow,
    ]);
  }

  private function getUsersToFollow(?User $user, int $limit = 5){
    return $user 
      ? $user->notFollowing()->limit($limit)->get() 
      : User::limit($limit)->get();
  }
}
