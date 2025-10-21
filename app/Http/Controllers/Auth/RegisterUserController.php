<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\RegisterUserService;
use App\Http\Requests\RegisterUserRequest;

class RegisterUserController extends Controller
{
  public function create()
  {
    return view('auth.register');
  }

  public function store(RegisterUserService $registerUserService, RegisterUserRequest $request)
  {
    $user = $registerUserService->createUser($request->validated());

    Auth::login($user);

    return redirect('/');
  }
}
