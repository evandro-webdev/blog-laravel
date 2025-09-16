<div 
  x-show="menuOpen" 
  x-cloak
  x-transition:enter="transition ease-out duration-200"
  x-transition:enter-start="opacity-0 scale-95"
  x-transition:enter-end="opacity-100 scale-100"
  x-transition:leave="transition ease-in duration-75"
  x-transition:leave-start="opacity-100 scale-100"
  x-transition:leave-end="opacity-0 scale-95"
  class="w-32 mt-2 rounded-md absolute right-0 bg-white dark:bg-gray-800 border 
        border-gray-200 dark:border-gray-700 shadow-lg z-10 overflow-hidden"
>
  @can('update', $comment)
    <x-blog.comment.menu-item
      action="editing=true; menuOpen=false"
      icon="edit"
      text="Editar"
      class="text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-gray-900"
    />
  @endcan

  @can('delete', $comment)
    <x-blog.comment.menu-item
      :action="'deleteComment(' . $comment->id . ')'"
      icon="trash"
      text="Excluir"
      class="text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-gray-900"
    />
  @endcan
</div>