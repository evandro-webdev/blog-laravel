<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilePictureRequest;
use App\Models\User;
use App\Http\Requests\ProfileRequest;
use App\Services\ProfileService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
  private ProfileService $profileService;

  public function __construct(ProfileService $profileService)
  {
    $this->profileService = $profileService;
  }

  public function show(User $user)
  {
    $isOwnProfile = Auth::check() && Auth::id() === $user->id;

    return view('profile.show', [
      'user' => $user, 
      'isOwnProfile' => $isOwnProfile
    ]);
  }

  public function update(ProfileRequest $request)
  {
    $user = $this->profileService->updateProfile(Auth::user(), $request->validated());

    return redirect()->route('profile.show', $user)->with('status', 'Perfil atualizado com sucesso');
  }

  public function updatePicture(ProfilePictureRequest $request, User $user)
  {
    $this->profileService->updateProfilePicture($request->validated()['profile_pic'], $user);

    return back()->with('status', 'Foto de perfil atualizada com sucesso');
  }
}
