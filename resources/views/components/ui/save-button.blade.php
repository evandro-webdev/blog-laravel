@props([
  'post'
])

<div 
  x-data="saveButton({{ $post->id }}, {{ Auth::user()->savedPosts->contains($post) ? 'true' : 'false' }}, '{{ csrf_token() }}')"
>
  <button
    @click="toggleSave"
    :disabled="loading"
    class="px-4 py-2 border rounded-lg font-medium cursor-pointer flex items-center gap-2 
           transition-colors duration-200"
    :class="isSaved 
      ? 'bg-blue-600 text-white border-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600' 
      : 'bg-transparent text-blue-600 border-blue-600 hover:bg-blue-50 dark:text-blue-400 dark:border-blue-400 dark:hover:bg-blue-500 dark:hover:text-white'"
  >
    <template x-if="!loading">
      <x-ui.icons.save class="w-5 h-5 text-inherit"/>
    </template>

    <x-ui.spinner x-show="loading" class="w-4 h-4"/>

    <span x-text="isSaved ? 'Salvo' : 'Salvar'"></span>
  </button>
</div>