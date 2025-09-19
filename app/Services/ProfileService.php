<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfilePictureRequest;
use Illuminate\Http\UploadedFile;

class ProfileService
{
  public function updateProfile(User $user, array $data): User
  {
    $user->update([
      'name' => $data['name'],
      'username' => $data['username'],
      'email' => $data['email'],
      'bio' => $data['bio'] ?? null,
      'city' => $data['city'] ?? null
    ]);

    $this->syncSocialProfiles($user, $data);

    return $user;
  }

  public function updateProfilePicture(UploadedFile $image, User $user): void
  {
    if($user->profile_pic){
      Storage::disk('public')->delete($user->profile_pic);
    }
    
    $path = $image->store('profile_pics', 'public');
    $user->update(['profile_pic' => $path]);
  }

  private function syncSocialProfiles(User $user, array $data): void
  {
    $socialProviders = ['twitter', 'github', 'instagram', 'linkedin', 'youtube'];
    
    foreach ($socialProviders as $provider) {
      $url = $data[$provider] ?? null;
      
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

  private function normalizeUrl(string $url): string
  {
    $url = trim($url);
    
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
      return "https://" . $url;
    }

    return $url;
  }
}