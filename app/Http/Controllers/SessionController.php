<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionRequest;
use App\Services\SessionService;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
  public function create()
  {
    return view('auth.login');
  }

  public function store(SessionService $sessionService, SessionRequest $request)
  {
    $sessionService->attemptLogin($request->validated());
    request()->session()->regenerate();

    return redirect('/');
  }

  public function destroy()
  {
    Auth::logout();
    return redirect('/');
  }
}
