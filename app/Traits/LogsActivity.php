<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
  public function logActivity(string $action, $subject = null, ?string $description = null)
  {
    ActivityLog::create([
      'user_id' => Auth::id(),
      'action' => $action,
      'description' => $description ?? ($subject->title ?? null),
      'subject_id'  => $subject?->id,
      'subject_type'=> $subject ? get_class($subject) : null,
    ]);
  }
}