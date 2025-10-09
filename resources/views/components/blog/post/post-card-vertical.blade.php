<article class="rounded-xl overflow-hidden bg-white dark:bg-slate-700 shadow-sm hover:shadow-md transition-shadow group">
  <x-blog.post.post-thumbnail :image="$post->image" :title="$post->title" loading="lazy"/>
    
  <div class="p-6">
    <x-ui.base.badge small variant="blue">{{ $post->category->name }}</x-ui.badge>

    <h3 class="my-2 font-semibold line-clamp-2 text-gray-800 dark:text-white">
      <a href="/posts/{{ $post->slug }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
        {{ $post->title }}
      </a>
    </h3>
    
    <p class="mb-6 text-sm line-clamp-2 text-gray-600 dark:text-gray-300">
      {{ $post->excerpt }}
    </p>
    
    <div class="flex items-center justify-between">
      <a href="{{ route('profile.show', $post->user) }}" class="flex items-center gap-2">
        <x-profile.avatar :user="$post->user" size="w-6 h-6"/>
        <span class="text-sm font-medium text-gray-700 dark:text-gray-100">{{ $post->user->name }}</span>
      </a>

      <div class="flex items-center gap-3 text-xs text-gray-600 dark:text-gray-100">
        <span class="flex items-center gap-1">
          <x-ui.icons.eye size="w-4 h-4"/>
          {{ number_format($post->views->count()) }}
        </span>
        
        <span class="flex items-center gap-1">
          <x-ui.icons.comment size="w-4 h-4"/>
          {{ $post->comments->count() }}
        </span>
      </div>
    </div>
  </div>
</article>