<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
  public function show()
  {
    $user = Auth::user();
    
    return view('auth.profile', ['user' => $user]);
  }
}
