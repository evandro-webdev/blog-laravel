<?php

namespace App\Http\Controllers;

use App\Events\CommentAdded;
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

    $comment = $post->comments()->create([
      'user_id' => Auth::id(),
      'content' => $attributes['content']
    ]);

    event(new CommentAdded($comment));
    
    $html = view('components.blog.comments.comment-item', compact('comment'))->render();
    
    return response()->json([
      'html' => $html,
      'id' => $comment->id
    ]);
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

    return response()->json([
      'message' => 'Comentário atualizado com sucesso!',
      'content' => $comment->content
    ]);
  }

  public function destroy(Comment $comment)
  {
    if(Auth::id() !== $comment->user_id){
      abort(403, 'Ação não autorizada.');
    }

    $post = $comment->post;
    $comment->delete();

    return response()->json([
      'message' => 'Comentário deletado com sucesso',
      'content' => $comment->content
    ]);
  }
}
