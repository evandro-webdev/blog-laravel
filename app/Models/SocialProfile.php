<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialProfile extends Model
{
  protected $fillable = ['user_id', 'provider', 'url'];
  
  public static $providers = [
    'twitter', 'facebook', 'instagram', 
    'linkedin', 'website', 'github', 'youtube'
  ];
    
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}