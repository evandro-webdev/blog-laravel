<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
  protected $casts = [
    'data' => 'array',
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function actor(): BelongsTo
  {
    return $this->belongsTo(User::class, 'actor_id');
  }

  public function notifiable()
  {
    return $this->morphTo();
  }

  public function markAsRead()
  {
    $this->update(['read_at' => now()]);
  }
}
