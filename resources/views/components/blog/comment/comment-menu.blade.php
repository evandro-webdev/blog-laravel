<div 
  x-show="open" @click.away="open = false" 
  x-transition
  class="absolute right-0 top-full mt-1 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1 min-w-[120px] z-10"
>
  @can('update', $comment)
    <button 
      @click="open = false; editing = true" 
      class="block w-full px-3 py-2 text-left text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
    >
      Editar
    </button>
  @endcan

  @can('update', $comment)
    <button 
      @click="deleteComment({{ $comment->id }}); open = false" 
      class="block w-full px-3 py-2 text-left text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700"
    >
      Excluir
    </button>
  @endcan
</div>