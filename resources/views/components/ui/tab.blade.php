@props(['value', 'icon'])

<div
  x-bind:class="{
    'border-1 border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-blue-600 dark:text-blue-400': {{ $attributes->get('x-model') }} === '{{ $value }}',
    'border-1 border-transparent text-gray-500 dark:text-slate-300 hover:text-gray-700 dark:hover:text-slate-100 bg-gray-50 dark:bg-slate-700': {{ $attributes->get('x-model') }} !== '{{ $value }}'
  }"
  class="px-5 py-2 rounded-md text-sm font-medium text-center cursor-pointer text-nowrap transition-colors flex-1 flex items-center justify-center gap-2"
  @click="{{ $attributes->get('x-model') }} = '{{ $value }}'"
>
  <x-dynamic-component 
    :component="'ui.icons.' . $icon"
  />
  {{ $slot }}
</div>

