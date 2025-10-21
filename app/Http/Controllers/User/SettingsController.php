<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Services\SettingsService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PreferencesRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Validation\ValidationException;

class SettingsController extends Controller
{
  private SettingsService $settingsService;

  public function __construct(SettingsService $settingsService)
  {
    $this->settingsService = $settingsService;
  }

  public function updatePassword(UpdatePasswordRequest $request)
  {
    $user = Auth::user();

    try {
      $this->settingsService->updatePassword($user, $request->validated());

      return redirect()
      ->back()
      ->with('message', 'Senha atualizada com sucesso!');
    } catch (ValidationException $e) {
      RateLimiter::hit($this->settingsService->getPasswordUpdateKey($user), 3600);

      return redirect()
        ->back()
        ->withErrors($e->errors())
        ->withFragment('seguranca');
    }
  }

  public function updatePreferences(PreferencesRequest $request)
  {
    $this->settingsService->updatePreferences(Auth::user(), $request->validated());

    return redirect()
      ->back()
      ->with('message', 'Preferências atualizadas com sucesso.');
  }

  public function deleteAccount(Request $request)
  {
    $user = $request->user();

    if(!Hash::check($request->passwordDelete, $user->password)){
      return back()->with('message', 'Falha ao excluir conta. Senha incorreta.');
    }

    $user->delete();
    Auth::logout();

    return redirect('/')->with('message', 'Conta excluída com sucesso!');
  }
}
