@props([
  'posts',
  'sort'
])

<div class="mb-4 text-sm flex items-center justify-between gap-2">
  <x-ui.forms.select-filter 
    :$sort 
    :options="['recent', 'popular', 'commented']"
  />
  <span class="text-gray-600 dark:text-gray-300">{{ $posts->count() }} posts</span> {{-- mudar para número de novos posts hoje --}}
</div>