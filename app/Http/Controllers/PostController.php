<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Traits\LogsActivity;
use Illuminate\Support\Facades\Auth;
use App\Services\PostService;
use App\Services\PostActionService;
use App\Http\Requests\PostRequest;
use App\Models\PostView;

class PostController extends Controller
{
  use LogsActivity;

  protected PostService $postService;
  protected PostActionService $postActionService;

  public function __construct(
    PostService $postService, 
    PostActionService $postActionService
  ){
    $this->postService = $postService;
    $this->postActionService = $postActionService;
  }

  // refatorar
  public function index()
  {
    $posts = Post::latest()
      ->where('published', true)
      ->paginate(6);

    return view('posts.index', compact('posts'));
  }

  public function show(Post $post)
  {
    PostView::recordView($post, Auth::user());
    $relatedPosts = $this->postService->getRelatedPosts($post, 3);

    return view('posts.show', compact('post', 'relatedPosts'));
  }

  public function create()
  {
    $categories = Category::all();
    return view('posts.create', compact('categories'));
  }

  public function store(PostRequest $request)
  {
    $post = $this->postActionService->createPost(
      Auth::user(),
      $request->validated(),
      $request->validated()['tags']
    );

    $this->logActivity('Post publicado', $post);

    return redirect('/admin/dashboard?tab=posts');
  }

  public function edit(Post $post)
  {
    $categories = Category::all();
    return view('posts.edit', ['post' => $post, 'categories' => $categories]);
  }

  public function update(PostRequest $request, Post $post)
  {
    $post = $this->postActionService->updatePost(
      $request->validated(),
      $request->validated()['tags'],
      $post
    );

    $this->logActivity('Post atualizado', $post);

    return redirect('/admin/dashboard?tab=posts');
  }

  public function destroy(Post $post)
  {
    $this->postActionService->deletePost($post);

    $this->logActivity('Post deletado', $post);

    return redirect('/admin/dashboard?tab=posts');
  }
}