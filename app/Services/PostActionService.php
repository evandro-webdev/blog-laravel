<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Events\PostPublished;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostActionService
{
  private PostTagService $postTagService;

  public function __construct(PostTagService $postTagService)
  {
    $this->postTagService = $postTagService;
  }

  public function createPost(User $user, array $data, ?string $tags = ''): Post
  {
    $postData = $this->preparePostData($data);
    $post = $user->posts()->create(Arr::except($postData, 'tags'));

    if(!empty($tags)){
      $this->postTagService->addTags($post, $tags);
    }

    //fix
    if($post->published){
      event(new PostPublished($post));
    }

    return $post;
  }

  public function updatePost(array $data, ?string $tags = '', Post $post): Post
  {
    $postData = $this->preparePostData($data, $post);
    $post->update(Arr::except($postData, 'tags'));
    if(!empty($tags)){
      $this->postTagService->syncTags($post, $tags);
    }
    
    if($post->published){
      event(new PostPublished($post));
    }

    return $post;
  }

  public function deletePost(Post $post): void
  {
    if($post->image){
      Storage::disk('public')->delete($post->image);
    }

    $post->delete();
  }

  private function preparePostData(array $data, ?Post $post = null): array
  {
    $data['slug'] = $this->generateSlug($data['title'], $post);
    $data['published'] = !empty($data['published']) ? true : false;
    $data['featured'] = !empty($data['featured']) ? true : false;

    if(isset($data['image'])){
      $data['image'] = $this->handleImageUpload($data['image'], $post);
    }

    if(empty($data['exerpt']) && !empty($data['content'])){
      $data['excerpt'] = Str::limit(strip_tags($data['content']), 150);
    }

    return $data;
  }

  private function generateSlug(string $title, ?Post $post = null): string
  {
    $baseSlug = Str::slug($title);
    $slug = $baseSlug;
    $counter = 1;

    while (Post::where('slug', $slug)->where('id', '!=', $post?->id)->exists()){
      $slug = $baseSlug . '-' . $counter;
      $counter++;
    }

    return $slug;
  }

  private function handleImageUpload(UploadedFile $image, ?Post $post = null): string
  {
    if($post?->image){
      Storage::disk('public')->delete($post->image);
    }

    return $image->store('posts', 'public');
  }
}