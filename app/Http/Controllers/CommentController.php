<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Services\CommentService;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
  use AuthorizesRequests;

  private CommentService $commentService;

  public function __construct(CommentService $commentService)
  {
    $this->commentService = $commentService; 
  }

  public function store(Post $post, CommentRequest $request)
  {
    $comment = $this->commentService->createComment($post, Auth::user(), $request->validated());

    $html = view('components.blog.comment.comment-item', compact('comment'))->render();

    return response()->json([
      'success' => true,
      'data' => [
        'id' => $comment->id,
        'message' => 'Comentário adicionado com sucesso!',
        'html' => $html
      ]
    ], 201);
  }

  public function update(Comment $comment, CommentRequest $request)
  {
    $this->authorize('update', $comment);
  
    $updatedComment = $this->commentService->updateComment($comment, $request->validated());

    return response()->json([
      'success' => true,
      'data' => [ 
        'id' => $updatedComment->id,
        'message' => 'Comentário atualizado com sucesso!'
      ]
    ], 201);
  }

  public function destroy(Comment $comment)
  {
    $this->authorize('delete', $comment);

    $this->commentService->deleteComment($comment);

    return response()->json([
      'success' => true,
      'data' => [
        'content' => $comment->content,
        'message' => 'Comentário deletado com sucesso'
      ]
    ]);
  }
}
