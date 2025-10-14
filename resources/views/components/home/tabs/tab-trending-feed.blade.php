<div x-show="tab === 'trending-feed'">
  @if ($posts->count() > 0)
    <x-home.filter-container :$posts :$sort/>

    <div class="space-y-4">
      @foreach ($posts as $post)
        <x-blog.post.post-card-horizontal :$post/>
      @endforeach
    </div>
  @else
    <x-ui.utilities.message message="Não há publicações para disponíveis"/>
  @endif
</div>