<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends Model
{
  use HasFactory;

  public function posts(): HasMany
  {
    return $this->hasMany(Post::class);
  }

  public function views(): HasManyThrough
  {
    return $this->hasManyThrough(PostView::class, Post::class, 'category_id', 'post_id', 'id', 'id');
  }
}
