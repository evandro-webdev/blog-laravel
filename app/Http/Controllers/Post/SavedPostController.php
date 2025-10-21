<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Events\PostSaved;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SavedPostController extends Controller
{
  public function store(Post $post)
  {
    Auth::user()->savePost($post);

    event(new PostSaved($post, Auth::user()));

    return response()->json([
      'success' => true,
      'message' => 'Post salvo',
      'saved' => true
    ]);
  }

  public function destroy(Post $post)
  {
    Auth::user()->unsavePost($post);

    return response()->json([
      'success' => true,
      'message' => 'Post marcado como não salvo',
      'saved' => false
    ]);
  }
}
