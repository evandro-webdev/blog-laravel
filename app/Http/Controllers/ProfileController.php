<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
    $attributes = $request->validate([
      'name' => ['required'],
      'email' => ['required', 'email', 'unique:users,email'],
      'bio' => ['nullable', 'string', 'max:500'],

      'social_networks' => ['nullable', 'array'],
      'social_networks.*.provider' => ['required', 'string', 'in:twitter, instagram, facebook, linkedin, github, website, youtube'],
      'social_networks.*.url' => ['required', 'url']
    ]);

    DB::transaction(function () use ($request, $attributes){
      $user = Auth::user();

      $user->update([
        'name' => $attributes['name'],
        'email' => $attributes['email'],
        'bio' => $attributes['bio'] ?? null,
      ]);

      if($request->has('social_networks')){
        $this->syncSocialProfiles($user, $attributes['social_networks']);
      }
    });

    return response()->json(['success' => 'Perfil atualizado']);
  }

  protected function syncSocialProfiles(User $user, array $socialNetworks){
    $user->socialProfiles()->delete();

    foreach($socialNetworks as $network){
      $user->socialProfiles()->create([
        'provider' => $network['provider'],
        'url' => $this->normalizeUrl($network['url'], $network['provider']),
      ]);
    }
  }

  protected function normalizeUrl($url, $provider){
    if(!preg_match("~^(?:f|ht)tps?://~i", $url)){
      return "https://" . $url;
    }

    return $url;
  }
}
