<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class ProfileController extends Controller
{
  public function myProfile()
  {
    $user = Auth::user();

    return view('profile.show', ['user' => $user, 'isOwnProfile' => true]);
  }

  public function show(User $user)
  {
    $isOwnProfile = Auth::check() && Auth::id() === $user->id;

    return view('profile.show', ['user' => $user, 'isOwnProfile' => $isOwnProfile]);
  }

  public function update(ProfileRequest $request)
  {
    $user = Auth::user();
    $attributes = $request->validated();

    $user->update([
      'name' => $attributes['name'],
      'email' => $attributes['email'],
      'bio' => $attributes['bio'] ?? null,
      'city' => $attributes['city'] ?? null
    ]);

    $this->syncSocialProfiles($user, $attributes);

    return redirect('/profile?tab=data');
  }

  public function updatePicture(Request $request)
  {
    $request->validate([
      'profile_pic' => ['required', 'image', 'max:2048', File::types(['jpg', 'webp'])]
    ]);

    $user = $request->user();

    if($user->profile_pic){
      Storage::disk('public')->delete($user->profile_pic);
    }
    
    $path = $request->file('profile_pic')->store('profile_pics', 'public');
    $user->profile_pic = $path;
    $user->save();

    return back()->with('status', 'Foto de perfil atualizada');
  }

  private function syncSocialProfiles($user, array $validatedData)
  {
    $socialProviders = ['twitter', 'github', 'instagram', 'linkedin', 'youtube'];
    
    foreach ($socialProviders as $provider) {
      $url = $validatedData[$provider] ?? null;
      
      if ($url) {
        $user->socialProfiles()->updateOrCreate(
          ['provider' => $provider],
          ['url' => $this->normalizeUrl($url)]
        );
      } else {
        $user->socialProfiles()->where('provider', $provider)->delete();
      }
    }
  }

  protected function normalizeUrl($url)
  {
    $url = trim($url);
    
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
      return "https://" . $url;
    }

    return $url;
  }
}
