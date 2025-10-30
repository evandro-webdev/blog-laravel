<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\Category;
use App\Models\PostView;
use App\Traits\LogsActivity;
use App\Services\PostService;
use App\Services\PostActionService;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
  use LogsActivity;
  use AuthorizesRequests;

  public function __construct(
    private PostService $postService, 
    private PostActionService $postActionService
  ){}

  public function show(Post $post)
  {
    PostView::recordView($post, Auth::user());
    $relatedPosts = $this->postService->getRelatedPosts($post, 3);
    $trendingPosts = $this->postService->getTrendingPostsInPeriod(7);

    return view('posts.show', compact('post', 'relatedPosts', 'trendingPosts'));
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

    return redirect()->route('dashboard.personal.posts')
      ->with('message', 'Post criado com sucesso');
  }

  public function edit(Post $post)
  {
    $this->authorize('update', $post);

    $categories = Category::all();
    return view('posts.edit', ['post' => $post, 'categories' => $categories]);
  }

  public function update(PostRequest $request, Post $post)
  {
    $this->authorize('update', $post);

    $post = $this->postActionService->updatePost(
      $request->validated(),
      $request->validated()['tags'],
      $post
    );

    $this->logActivity('Post atualizado', $post);

    return redirect()->route('dashboard.personal.posts')
      ->with('message', 'Post atualizado com sucesso');
  }

  public function destroy(Post $post)
  {
    $this->authorize('delete', $post);

    $this->postActionService->deletePost($post);

    $this->logActivity('Post deletado', $post);

    return redirect('/dashboard/posts')
      ->with('message', 'Post deletado com sucesso');
  }
}