<div x-show="tab === 'personal-feed'">
  @if ($posts->count() > 0)
    <x-home.filter-container :$posts :$sort/>

    <div class="space-y-4">
      @foreach ($posts as $post)
        <x-blog.post.post-card-horizontal :$post/>
      @endforeach
    </div>
  @else
    <x-ui.message message="Não há publicações para você, comece a seguir autores para ver novas publicações"/>
  @endif
</div>