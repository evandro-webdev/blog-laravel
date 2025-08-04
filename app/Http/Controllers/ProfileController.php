<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
  public function show()
  {
    $user = Auth::user();
    
    return view('auth.profile', ['user' => $user]);
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
