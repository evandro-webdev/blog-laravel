@props([
  'posts',
  'sort'
])

<div class="mb-4 text-sm flex items-center justify-between gap-2">
  <div class="flex items-center gap-2">
    <div class="flex items-center gap-2">
      <x-ui.icons.filter class="text-gray-600 dark:text-gray-300"/>
      <span class="text-gray-700 dark:text-gray-200">Ordenar por:</span>
    </div>
    <x-ui.forms.select-filter 
      :$sort 
      :options="['recent', 'popular', 'commented']"
    />
  </div>
  <span class="text-gray-600 dark:text-gray-300">{{ $posts->count() }} posts</span> {{-- mudar para número de novos posts --}}
</div>