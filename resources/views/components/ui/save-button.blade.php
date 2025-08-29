@props([
  'post'
])

<div 
  x-data="saveButton({{ $post->id }}, {{ Auth::user()->savedPosts->contains($post) ? 'true' : 'false' }}, '{{ csrf_token() }}')"
>
  <button
    @click="toggleSave"
    :disabled="loading"
    class="px-3 py-2 rounded-md font-medium cursor-pointer flex items-center gap-2 transition-colors duration-200"
    :class="isSaved 
      ? 'border border-blue-600 bg-blue-600 text-white hover:bg-blue-700' 
      : 'border border-blue-600 text-blue-600 hover:bg-blue-100'"
  >
    <template x-if="!loading">
      <img 
        :src="isSaved ? '{{ asset('images/icons/unsave.svg') }}' : '{{ asset('images/icons/save.svg') }}'" 
        alt=""
        class="inline-block h-[1.4em] w-[1.4em]"
      />
    </template>

    <x-ui.spinner x-show="loading" class="w-4 h-4"/>

    <span x-text="isSaved ? 'Salvo' : 'Salvar'"></span>
  </button>
</div>