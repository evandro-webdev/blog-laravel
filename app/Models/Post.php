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

  public function readers(): BelongsToMany
  {
    return $this->belongsToMany(User::class, 'read_posts')->withPivot('created_at');
  }

  public function savedBy(): BelongsToMany
  {
    return $this->belongsToMany(User::class, 'saved_posts');
  }

  public function markAsRead(User $user)
  {
    $this->readers()->syncWithoutDetaching([
      $user->id => ['created_at' => now()]
    ]);
  }

  public function markAsUnread(User $user)
  {
    $this->readers()->detach($user->id);
  }

  public function related(int $limit = 3)
  {
    return Post::query()
      ->where(function($query) {
        $query->whereHas('tags', function($q) {
          $q->whereIn('tags.id', $this->tags->pluck('id'));
        })
        ->orWhere('category_id', $this->category_id);
      })
      ->where('id', '!=', $this->id)
      ->where('published', true)
      ->latest()
      ->take($limit)
      ->get();
  }

  public function scopeMostViewedThisWeek($query, int $limit = 4)
  {
    return $query->where('published', true)
              ->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
              ->orderByDesc('views')
              ->take($limit);
  }
}