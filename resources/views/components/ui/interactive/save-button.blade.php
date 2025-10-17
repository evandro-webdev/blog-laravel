@props([
  'post'
])

<div 
  x-data="actionButton(
    '{{ '/posts/' . $post->id . '/save' }}',
    {{ Auth::user()->savedPosts->contains($post) ? 'true' : 'false' }},
    '{{ csrf_token() }}'
  )"
>
  <button
    @click="toggleActive"
    :disabled="loading"
    class="px-4 py-2 rounded-lg text-sm font-medium cursor-pointer flex items-center gap-2 transition-colors duration-200"
    :class="isActive 
      ? 'text-white bg-blue-600 hover:bg-blue-700' 
      : 'text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600'"
  >
    <template x-if="!loading">
      <x-ui.icons.save size="w-4 h-4" stroke="2" class="text-inherit"/>
    </template>

    <x-ui.base.spinner x-show="loading"/>

    <span x-text="isActive ? 'Salvo' : 'Salvar'"></span>
  </button>
</div>