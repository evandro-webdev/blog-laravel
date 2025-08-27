<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
  public function updatePassword()
  {
    $user = Auth::user();
    $key = Str::lower($user->email) . '|password-update';

    if(RateLimiter::tooManyAttempts($key, 3)){
      $seconds = RateLimiter::availableIn($key);
      return back()
        ->withErrors([
          'current_password' => "Você excedeu o número de tentativas. Tente novamente em {$seconds} segundos.",
        ])
        ->withFragment('seguranca');
    }

    $attributes = Validator::make(request()->all(), [
      'current_password' => ['required', 'current_password',],
      'password' => ['required', Password::min(6), 'confirmed', 'different:current_password']
    ]);

    if($attributes->fails()){
      RateLimiter::hit($key, 3600);
      return back()
        ->withErrors($attributes)
        ->withFragment('seguranca');
    }

    $user->update([
      'password' => Hash::make($attributes->validated()['password'])
    ]);

    RateLimiter::clear($key);

    return redirect()
      ->back()
      ->with('success', 'Senha atualizada com sucesso!');
  }
}
