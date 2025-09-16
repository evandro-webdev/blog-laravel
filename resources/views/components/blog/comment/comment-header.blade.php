<header class="flex items-center justify-between">

  <div class="flex items-center gap-2">
    <a href="{{ route('profile.show', $comment->user) }}" 
        class="font-medium text-gray-800 dark:text-white">
      {{ $comment->user->name }}
    </a>
    <time class="text-xs text-gray-600 dark:text-gray-300" datetime="{{ $comment->created_at }}">
      {{ $comment->created_at->diffForHumans() }}
    </time>
  </div>

  @canany(['update', 'delete'], $comment)
    <div class="relative" @click.away="menuOpen=false">
      <button 
        @click="menuOpen=!menuOpen"
        class="p-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700" 
      >
        <x-ui.icons.ellipsis class="text-gray-700 dark:text-gray-100"/>
      </button>

      <x-blog.comment.comment-menu :$comment/>   
    </div>
  @endcanany
</header>