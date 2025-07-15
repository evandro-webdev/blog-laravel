<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
  public function subject(){
    return $this->morphTo();
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function getSubjectUrlAttribute()
  {
    if (!$this->subject) return null;
    
    return match (get_class($this->subject)) {
      'App\Models\Post' => route('posts.show', $this->subject->slug),
      default => null,
    };
  }
}