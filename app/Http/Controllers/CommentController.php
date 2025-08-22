<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
  public function store(Post $post)
  {
    $attributes = request()->validate([
      'content' => ['required', 'string', 'max:1000']
    ]);

    $post->comments()->create([
      'user_id' => Auth::id(),
      'content' => $attributes['content']
    ]);

    return redirect()->route('posts.show', $post);
  }
}
