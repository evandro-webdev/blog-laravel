@props([
  'post'
])

<div 
  x-data="readButton({{ $post->id }}, {{ Auth::user()->readPosts->contains($post) ? 'true' : 'false' }}, '{{ csrf_token() }}')"
>
  <button
    @click="toggleRead"
    :disabled="loading"
    class="px-4 py-2 border rounded-lg font-medium cursor-pointer flex items-center gap-2 
           transition-colors duration-200"
    :class="isRead
      ? 'bg-blue-600 text-white border-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600'
      : 'bg-transparent text-blue-600 border-blue-600 hover:bg-blue-50 dark:text-blue-400 dark:border-blue-400 dark:hover:bg-blue-500 dark:hover:text-white'"
  >
    <template x-if="!loading">
      <x-ui.icons.eye class="w-5 h-5 text-inherit"/>
    </template>

    <x-ui.spinner x-show="loading" class="w-4 h-4"/>

    <span x-text="isRead ? 'Lido' : 'Marcar como lido'"></span>
  </button>
</div>

