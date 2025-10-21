<?php

namespace App\Http\Controllers\Auth;

use App\Services\SessionService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SessionRequest;

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
