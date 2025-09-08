@props(['value'])

<div
  x-bind:class="{
    'border-1 border-gray-200 bg-white text-blue-600': {{ $attributes->get('x-model') }} === '{{ $value }}',
    'text-gray-600 hover:text-gray-800': {{ $attributes->get('x-model') }} !== '{{ $value }}'
  }"
  class="px-5 py-2 text-sm font-medium text-center flex-1 cursor-pointer text-nowrap transition-colors rounded-md"
  @click="{{ $attributes->get('x-model') }} = '{{ $value }}'"
>
  {{ $slot }}
</div>

