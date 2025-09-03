<?php

namespace App\Models;

use App\Traits\HasUserStats;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasFactory, Notifiable, HasUserStats;

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

  public function readPosts(): BelongsToMany
  {
    return $this->belongsToMany(Post::class, 'read_posts')->withPivot('created_at');
  }

  public function savedPosts(): BelongsToMany
  {
    return $this->belongsToMany(Post::class, 'saved_posts');
  }

  public function savePost(Post $post)
  {
    return $this->savedPosts()->syncWithoutDetaching([$post->id]);
  }

  public function unsavePost(Post $post)
  {
    return $this->savedPosts()->detach($post->id);
  }

  public function comments(): HasMany
  {
    return $this->hasMany(Comment::class);
  }

  public function notifications(): HasMany
  {
    return $this->hasMany(Notification::class, 'user_id')->latest();
  }

  public function unreadNotifications(): HasMany
  {
    return $this->notifications()->whereNull('read_at'); 
  }

  public function markAllNotificationsAsRead(): void
  {
    $this->unreadNotifications()->update(['read_at' => now()]);
  }

  public function followers(): BelongsToMany
  {
    return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id')
                ->withPivot('created_at');
  }

  public function following(): BelongsToMany
  {
    return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id')
                ->withPivot('created_at');
  }

  public function isFollowing($userId)
  {
    return $this->following()->where('users.id', $userId)->exists();
  }

  public function isFollowedBy($userId)
  {
    return $this->followers()->where('users.id', $userId)->exists();
  }
}
