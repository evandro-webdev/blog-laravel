<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class SettingsService
{
  public function updatePassword(User $user, array $data): void
  {
    $key = $this->getPasswordUpdateKey($user);

    $this->checkPasswordUpdateRateLimit($key);

    $user->update([
      'password' => Hash::make($data['password'])
    ]);

    RateLimiter::clear($key);
  }

  public function updatePreferences(User $user, array $data): void
  {
    $user->update($data);
  }

  public function getPasswordUpdateKey(User $user): string
  {
    return 'password-update:' . $user->id;
  }

  private function checkPasswordUpdateRateLimit(string $key): void
  {
    if(RateLimiter::tooManyAttempts($key, 3)){
      $seconds = RateLimiter::availableIn($key);
      
      throw ValidationException::withMessages([
        'current_password' => "Você excedeu o número de tentativas. Tente novamente em {$seconds} segundos."
      ]);
    }
  }
}