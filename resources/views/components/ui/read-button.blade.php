@props([
  'post'
])

<div 
  x-data="readButton({{ $post->id }}, {{ Auth::user()->readPosts->contains($post) ? 'true' : 'false' }}, '{{ csrf_token() }}')"
>
  <button
    @click="toggleRead"
    :disabled="loading"
    class="px-3 py-2 rounded-md font-medium cursor-pointer flex items-center gap-2 transition-colors duration-200"
    :class="isRead 
      ? 'border border-blue-600 bg-blue-600 text-white hover:bg-blue-700' 
      : 'border border-blue-600 text-blue-600 hover:bg-blue-100'"
  >
    <template x-if="!loading">
      <x-ui.icons.eye class="isRead ? 'text-blue-600' : 'text-white'"/>
    </template>

    <x-ui.spinner x-show="loading" class="w-4 h-4"/>

    <span x-text="isRead ? 'Lido' : 'Marcar como lido'"></span>
  </button>
</div>
