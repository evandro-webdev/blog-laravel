<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostReadController extends Controller
{
  public function store(Post $post)
  {
    $post->markAsRead(Auth::user());

    return response()->json([
      'success' => true,
      'message' => 'Post marcado como lido',
      'read' => true
    ]);
  }

  public function destroy(Post $post)
  {
    $post->markAsUnread(Auth::user());

    return response()->json([
      'success' => true,
      'message' => 'Post marcado como não lido',
      'read' => false
    ]);
  }
}
