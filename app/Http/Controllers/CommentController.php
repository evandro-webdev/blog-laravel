<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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

  public function update(Comment $comment)
  {
    if(Auth::id() !== $comment->user_id){
      abort(403, 'Ação não autorizada.');
    }
    
    $attributes = request()->validate([
      'content' => ['required', 'string', 'max:1000']
    ]);
    
    $comment->update($attributes);

    return redirect()->route('posts.show', $comment->post);
  }

  public function destroy(Comment $comment)
  {
    if(Auth::id() !== $comment->user_id){
      abort(403, 'Ação não autorizada.');
    }

    $post = $comment->post;
    $comment->delete();

    return redirect()->route('posts.show', $post);
  }
}
