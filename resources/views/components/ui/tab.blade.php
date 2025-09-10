@props(['value', 'icon'])

<div
  x-bind:class="{
    'border-1 border-gray-200 bg-white text-blue-600': {{ $attributes->get('x-model') }} === '{{ $value }}',
    'text-gray-500 hover:text-gray-800 bg-gray-50': {{ $attributes->get('x-model') }} !== '{{ $value }}'
  }"
  class="px-5 py-2 rounded-md text-sm font-medium text-center cursor-pointer text-nowrap transition-colors flex-1 flex items-center justify-center gap-2"
  @click="{{ $attributes->get('x-model') }} = '{{ $value }}'"
>
  <x-dynamic-component 
    :component="'ui.icons.' . $icon"
  />
  {{ $slot }}
</div>

