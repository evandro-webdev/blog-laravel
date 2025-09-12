<div x-show="tab === 'personal-feed'">
  <div class="mb-4 text-sm flex items-center justify-between gap-2">
    <div class="flex items-center gap-2">
      <div class="flex items-center gap-2">
        <x-ui.icons.filter class="text-gray-600"/>
        <span class="text-gray-700">Ordenar por:</span>
      </div>
      <x-ui.forms.select-filter 
        :$sort 
        :options="['recent', 'popular', 'commented']"
      />
    </div>
    <span class="text-gray-600">{{ $posts->count() }} posts</span>
  </div>

  <div class="space-y-4">
    @foreach ($posts as $post)
      <div class="rounded-md overflow-hidden flex flex-col sm:flex-row ">
        <x-blog.post.post-thumbnail :link="$post->image" class="sm:w-1/3 sm:aspect-[4/3] object-cover"/>
        
        <div class="p-4 rounded-b-md sm:rounded-l-none sm:rounded-t-md 
          border-1 border-t-0 sm:border-t-1 sm:border-l-0 
          border-gray-200 space-y-4 bg-white flex flex-col flex-1 justify-center"
        >
          <div class="flex items-center gap-2">
            <div class="flex items-center gap-2">
              <x-profile.avatar :user="$post->user" size="w-7 h-7"/>
              <span class="text-sm font-medium text-gray-700">{{ $post->user->name }}</span>
            </div>
            <span class="text-gray-600">·</span>
            <time class="text-xs text-gray-600" datetime="{{ $post->created_at }}">
              {{ $post->created_at->diffForHumans() }}
            </time>
          </div>

          <a href="{{ route('posts.show', $post) }}" class="space-y-1">
            <h3 class="font-bold text-xl text-gray-800">{{ $post->title }}</h3>
            <p class="text-gray-600 line-clamp-2">{{ $post->excerpt }}</p>
          </a>

          <div class="flex items-center justify-between">
            <x-ui.badge small>{{ $post->category->name }}</x-ui.badge>
            <div class="text-gray-600 flex items-center gap-2">
              <div class="flex items-center gap-1">
                <x-ui.icons.save size="w-4 h-4"/>
                <span class="text-xs">{{ $post->savedBy->count() }}</span>
              </div>
              <div class="flex items-center gap-1">
                <x-ui.icons.comment size="w-4 h-4"/>
                <span class="text-xs">{{ $post->comments->count() }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>