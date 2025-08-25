<?php

namespace App\Traits;

trait HasUserStats
{
  public function getCommentsCount(): int
  {
    return $this->comments()->count();
  }

  public function getFollowersCount(): int
  {
    return $this->followers()->count();
  }

  public function getFollowingCount(): int
  {
    return $this->following()->count();
  }
}
