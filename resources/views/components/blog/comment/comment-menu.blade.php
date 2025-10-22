<div 
  x-show="open" 
  @click.away="open = false" 
  x-transition
  class="absolute right-0 top-full min-w-[120px] mt-1 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-slate-800 shadow-lg z-10 overflow-hidden"
>
  @can('update', $comment)
    <button 
      @click="open = false; editing = true" 
      class="block w-full px-3 py-2 text-left text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700"
    >
      Editar
    </button>
  @endcan

  @can('delete', $comment)
    <button
      @click="
        $dispatch('open-modal', {
          title: 'Apagar seu comentário?',
          content: 'Apagar um comentário é uma ação irreversivel, confirme ou cancele abaixo',
          onConfirm: () => deleteComment({{ $comment->id }})
        },
        open = false
      )"
      class="block w-full px-3 py-2 text-left text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-slate-700"
    >
      Excluir
    </button>
  @endcan
</div>