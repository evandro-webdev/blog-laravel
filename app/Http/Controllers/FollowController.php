<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
  public function store(User $user)
  {
    $currentUser = Auth::user();

    if($currentUser->id === $user->id){
      return response()->json(['error' => 'Você não pode seguir a si mesmo'], 400);
    }

    if($currentUser->isFollowing($user->id)){
      return response()->json(['error' => 'Você já segue esse usuário'], 400);
    }

    $currentUser->following()->attach($user->id);

    return response()->json([
      'message' => 'Usuário seguido com sucesso',
      'following' => true
    ]);
  }

  public function destroy(User $user)
  {
    $currentUser = Auth::user();

    if(!$currentUser->isFollowing($user->id)){
      return response()->json(['error' => 'Você não segue esse usuário'], 400);
    }

    $currentUser->following()->detach($user->id);

    return response()->json([
      'message' => 'Você deixou de seguir esse usuário',
      'following' => false
    ]);
  }
}
