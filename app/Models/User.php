<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasFactory, Notifiable;

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function socialProfiles(): HasMany
  {
    return $this->hasMany(SocialProfile::class);
  }

  public function posts(): HasMany
  {
    return $this->hasMany(Post::class);
  }

  public function followers(): BelongsToMany
  {
    return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id')
                ->withTimestamps()
                ->withPivot('created_at');
  }

  public function following(): BelongsToMany
  {
    return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id')
                ->withTimestamps()
                ->withPivot('created_at');
  }

  public function isFollowing($userId)
  {
    return $this->following()->where('id', $userId)->exists();
  }

  public function isFollowedBy($userId)
  {
    return $this->followers()->where('id', $userId)->exists();
  }
}
