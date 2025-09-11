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
    $usersToFollow = $this->getUsersToFollow($user);
    $sort = $this->resolveSort($request, $user);

    $postsFromFollowing = $this->postService->getFeed($user, $sort);
    $popularPosts = $this->postService->getFeed(null, $sort);

    return view('home.index', [
      'usersToFollow' => $usersToFollow,
      'user' => $user,
      'postsFromFollowing' => $postsFromFollowing,
      'popularPosts' => $popularPosts,
      'sort' => $sort
    ]);
  }

  private function getUsersToFollow(?User $user, int $limit = 5){
    return $user 
      ? $user->notFollowing()->limit(5)->get() 
      : User::limit(5)->get();
  }

  private function resolveSort(Request $request, ?User $user): string
  {
    $default = $user ? 'recent' : 'popular';
    return $request->query('sort', $default);
  }
}
