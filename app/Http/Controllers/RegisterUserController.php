<?php

namespace App\Http\Controllers;

use App\Services\RegisterUserService;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Auth;

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
