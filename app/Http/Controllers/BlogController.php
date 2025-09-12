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
    $sort = $this->resolveSort($request, $tab);

    $posts = $this->getFilteredPosts($tab, $sort, $user);

    $usersToFollow = $this->getUsersToFollow($user);
      
    return view('home.index', [
      'user' => $user,
      'posts' => $posts,
      'sort' => $sort,
      'tab' => $tab,
      'usersToFollow' => $usersToFollow,
    ]);
  }

  private function getFilteredPosts(string $tab, string $sort, ?User $user){
    if($tab === 'personal-feed' && $user){
      return $this->postService->getFeed($user, $sort);
    } else {
      return $this->postService->getFeed(null, $sort);
    }
  }

  private function getUsersToFollow(?User $user, int $limit = 5){
    return $user 
      ? $user->notFollowing()->limit(5)->get() 
      : User::limit(5)->get();
  }

  private function resolveSort(Request $request, string $tab): string
  {
    $default = $tab === 'trending-feed' ? 'popular' : 'recent';
    return $request->query('sort', $default);
  }
}
