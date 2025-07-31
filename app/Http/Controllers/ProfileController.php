<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
  public function show()
  {
    $user = Auth::user();
    
    return view('auth.profile', ['user' => $user]);
  }

  public function update(Request $request)
    {
        $user = Auth::user();

        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'bio' => ['nullable', 'string', 'max:500'],
            'city' => ['nullable', 'string', 'max:85'],
            
            'twitter' => ['nullable', 'url', 'max:255'],
            'github' => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
        ]);

        $user->update([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'bio' => $attributes['bio'],
            'city' => $attributes['city']
        ]);

        $this->syncSocials($user, $attributes);

        return redirect('/profile');
    }

    private function syncSocials($user, $data)
    {
      $socials = [
        'twitter' => $data['twitter'] ?? null,
        'github' => $data['github'] ?? null,
        'instagram' => $data['instagram'] ?? null,
        'linkedin' => $data['linkedin'] ?? null,
        'youtube' => $data['youtube'] ?? null,
      ];

      foreach ($socials as $provider => $url) {
        if ($url) {
          $normalizedUrl = $this->normalizeUrl($url);

          $user->socialProfiles()->updateOrCreate(
            ['provider' => $provider],
            ['url' => $normalizedUrl]
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
