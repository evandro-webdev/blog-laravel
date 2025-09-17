<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\FollowService;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
  protected FollowService $followService;

  public function __construct(FollowService $followService)
  {
    $this->followService = $followService;
  }

  public function store(User $user)
  {
    $this->followService->followUser(Auth::user(), $user);

    return response()->json([
      'success' => true,
      'message' => 'Usuário seguido com sucesso',
      'following' => true
    ]);
  }

  public function destroy(User $user)
  {
    $this->followService->unfollowUser(Auth::user(), $user);

    return response()->json([
      'success' => true,
      'message' => 'Você deixou de seguir esse usuário',
      'following' => false
    ]);
  }
}
