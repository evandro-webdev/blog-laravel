<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialProfile extends Model
{
    protected $fillable = ['user_id', 'provider', 'url'];
    
    public static $providers = [
        'twitter', 'facebook', 'instagram', 
        'linkedin', 'website', 'github', 'youtube'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}