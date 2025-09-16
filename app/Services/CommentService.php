<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Events\CommentAdded;

class CommentService
{
  public function createComment(Post $post, User $user, array $data): Comment
  {
    $comment = $post->comments()->create([
      'user_id' => $user->id,
      'content' => $data['content']
    ]);

    event(new CommentAdded($comment));

    return $comment;
  }

  public function updateComment(Comment $comment, $data): Comment
  {
    $comment->update($data);
    return $comment;
  }

  public function deleteComment(Comment $comment): bool
  {
    return $comment->delete();
  }
}