<div class="space-y-1">
  @foreach ($posts as $post)
    <a 
      href="{{ route('posts.show', $post) }}"
      class="p-2 rounded-md space-y-1 block hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
    >
      <h3 class="text-sm font-medium line-clamp-2 text-gray-800 dark:text-white">{{ $post->title }}</h3>
      <div class="text-xs text-gray-500 dark:text-gray-400 flex gap-2">
        <span class="text-nowrap">{{ $post->views->count() }} views</span>
        <span class="hidden sm:block">•</span>
        <span class="text-nowrap hidden sm:block">{{ $post->comments->count() }} comentários</span>
        <span>|</span>
        <time datetime="{{ $post->created_at }}" class="block text-nowrap">
          {{ $post->created_at->translatedFormat('d \d\e F, Y') }}
        </time>
      </div>
    </a>
  @endforeach
</div>