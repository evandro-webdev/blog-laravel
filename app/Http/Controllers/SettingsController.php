<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
  public function updatePassword()
  {
    $attributes = Validator::make(request()->all(), [
      'current_password' => ['required', 'current_password',],
      'password' => ['required', Password::min(6), 'confirmed', 'different:current_password']
    ]);

    if($attributes->fails()){
      return back()
        ->withErrors($attributes)
        ->withFragment('seguranca')
        ->withInput();
    }

    $user = Auth::user();
    $user->update([
      'password' => Hash::make($attributes->validated()['password'])
    ]);

    return redirect()->route('profile.myProfile');
  }
}
