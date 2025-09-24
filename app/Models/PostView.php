<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostView extends Model
{
  public function post(): BelongsTo
  {
    return $this->belongsTo(Post::class);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public static function recordView(Post $post, ?User $user = null): void
  {
    $ipAddress = request()->ip();

    $recentView = static::where('post_id', $post->id)
      ->where('ip_address', $ipAddress)
      ->where('viewed_at', '>=', now()->subHour())
      ->exists();

    if(!$recentView){
      static::create([
        'post_id' => $post->id,
        'user_id' => $user?->id,
        'ip_address' => $ipAddress,
        'viewed_at' => now()
      ]);
    }
  }
}
