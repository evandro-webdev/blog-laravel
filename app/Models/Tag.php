<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
  use HasFactory;

  public function posts(): BelongsToMany
  {
    return $this->belongsToMany(Post::class);
  }

  public function views()
  {
    return PostView::query()
      ->select('post_views.*')
      ->join('posts', 'post_views.post_id', '=', 'posts.id')
      ->join('post_tag', 'post_tag.post_id', '=', 'posts.id')
      ->where('post_tag.tag_id', $this->id)
      ->get();
  }

  public static function mostViewed(int $limit = 5)
  {
    return static::select('tags.*', DB::raw('COUNT(post_views.id) as total_views'))
      ->join('post_tag', 'post_tag.tag_id', '=', 'tags.id')
      ->join('posts', 'posts.id', '=', 'post_tag.post_id')
      ->join('post_views', 'post_views.post_id', '=', 'posts.id')
      ->groupBy('tags.id')
      ->orderByDesc('total_views')
      ->limit($limit)
      ->get();
  }
}
