<?php

namespace App\Services;

use App\Models\User;
use App\Events\UserFollowed;

class FollowService
{
  public function followUser(User $follower, User $userToFollow)
  {
    if($follower->id === $userToFollow->id){
      return response()->json([
        'sucess' => false,
        'message' => 'Você não pode seguir a si mesmo'
      ]);
    }

    if($follower->isFollowing($userToFollow->id)){
      return response()->json([
        'success' => false,
        'message' => 'Você já segue esse usuário'
      ]);
    }

    $follower->following()->attach($userToFollow->id);
    event(new UserFollowed($follower, $userToFollow));    
  }

  public function unfollowUser(User $follower, User $userToUnfollow)
  {
    if(!$follower->isFollowing($userToUnfollow->id)){
      return response()->json([
        'success' => false,
        'message' => 'Você não segue esse usuário'
      ]);
    }

    $follower->following()->detach($userToUnfollow->id);
  }
}