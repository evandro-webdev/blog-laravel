<?php 

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionService
{
  public function attemptLogin(array $data)
  {
    if(!Auth::attempt($data)){
      throw ValidationException::withMessages([
        'email' => 'Dados incorretos'
      ]);
    }
  }
}