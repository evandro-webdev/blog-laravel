<footer class="flex items-center gap-4" x-show="!editing">
  <button class="flex items-center gap-1 text-sm text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 transition-colors">
    <x-ui.icons.heart size="w-4 h-4" stroke="2"/>
    <span>Curtir</span>
  </button>
    
  <button class="flex items-center gap-1 text-sm text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 transition-colors">
    <x-ui.icons.corner-up-left size="w-4 h-4" stroke="2"/>
    <span>Responder</span>
  </button>
    
  @can('delete', $comment)
    <div class="relative ml-auto" x-data="{ open: false }">
      <button 
        @click="open = !open" 
        class="p-1 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 rounded transition-colors"
      >
        <x-ui.icons.ellipsis />
      </button>
      
      <x-blog.comment.comment-menu :$comment/>
    </div>
  @endcan
  </footer>