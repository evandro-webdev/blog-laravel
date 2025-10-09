<?php

namespace App\Http\Controllers;

use App\Http\Requests\PreferencesRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
