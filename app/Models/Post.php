<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
  use HasFactory;

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class);
  }

  public function tags(): BelongsToMany
  {
    return $this->belongsToMany(Tag::class);
  }

  public function comments(): HasMany
  {
    return $this->hasMany(Comment::class)->latest();
  }

  public function postViews(): HasMany
  {
    return $this->hasMany(PostView::class);
  }

  public function viewsInPeriod(int $days): int
  {
    return $this->postViews()
      ->where('viewed_at', '>=', now()->subDays($days))
      ->count();
  }

  public function readers(): BelongsToMany
  {
    return $this->belongsToMany(User::class, 'read_posts')->withPivot('created_at');
  }

  public function savedBy(): BelongsToMany
  {
    return $this->belongsToMany(User::class, 'saved_posts');
  }

  public function markAsRead(User $user): void
  {
    $this->readers()->syncWithoutDetaching([
      $user->id => ['created_at' => now()]
    ]);
  }

  public function markAsUnread(User $user): void
  {
    $this->readers()->detach($user->id);
  }
}