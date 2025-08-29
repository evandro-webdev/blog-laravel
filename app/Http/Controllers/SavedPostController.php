<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedPostController extends Controller
{
  public function store(Post $post)
  {
    Auth::user()->savePost($post);

    return response()->json([
      'message' => 'Post salvo',
      'saved' => true
    ]);
  }

  public function destroy(Post $post)
  {
    Auth::user()->unsavePost($post);

    return response()->json([
      'message' => 'Post marcado como não salvo',
      'saved' => false
    ]);
  }
}
