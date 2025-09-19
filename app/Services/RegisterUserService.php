<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

class RegisterUserService
{
  public function createUser(array $data): User
  {
    $data['username'] = Str::slug($data['name'], '_') . rand(1, 9999);
    $user = User::create($data);

    return $user;
  }
}