<div class="space-y-4">
  @foreach ($posts as $post)
    <a 
      href="{{ route('posts.show', $post) }}"
      class="p-2 rounded-md space-y-1 block hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors"
    >
      <h3 class="text-sm font-medium line-clamp-2 text-gray-800 dark:text-white">{{ $post->title }}</h3>
      <div class="text-xs text-gray-500 dark:text-gray-400 flex gap-2">
        <span class="text-nowrap">{{ $post->views->count() }} views</span>
        <span class="hidden sm:block">•</span>
        <span class="text-nowrap hidden sm:block">{{ $post->comments->count() }} comentários</span>
        <span>|</span>
        <x-ui.utilities.datetime :date="$post->created_at" format="d \d\e F, Y"/>
      </div>
    </a>
  @endforeach
</div>