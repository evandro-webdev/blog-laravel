@props(['value', 'icon'])

<div
  x-bind:class="{
    'border-1 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-blue-600 dark:text-blue-400': {{ $attributes->get('x-model') }} === '{{ $value }}',
    'text-gray-500 dark:text-white hover:text-gray-700 dark:hover:text-gray-300 bg-gray-50 dark:bg-gray-800': {{ $attributes->get('x-model') }} !== '{{ $value }}'
  }"
  class="px-5 py-2 rounded-md text-sm font-medium text-center cursor-pointer text-nowrap transition-colors flex-1 flex items-center justify-center gap-2"
  @click="{{ $attributes->get('x-model') }} = '{{ $value }}'"
>
  <x-dynamic-component 
    :component="'ui.icons.' . $icon"
  />
  {{ $slot }}
</div>

