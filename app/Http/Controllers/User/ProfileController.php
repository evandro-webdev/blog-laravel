<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Services\ProfileService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProfilePictureRequest;

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

    return redirect()->route('profile.show', $user)->with('message', 'Perfil atualizado com sucesso');
  }

  public function updatePicture(ProfilePictureRequest $request, User $user)
  {
    $this->profileService->updateProfilePicture($request->validated()['profile_pic'], $user);

    return back()->with('message', 'Foto de perfil atualizada com sucesso');
  }
}
