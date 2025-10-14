@props(['value', 'icon'])

@php
  $model = $attributes->get('x-model');
@endphp

<div
  class="px-1 py-2 rounded-md border text-sm font-medium text-center cursor-pointer text-nowrap transition-colors flex-1 flex items-center justify-center gap-1 lg:gap-2"
  x-bind:class="{
    'border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-700 text-blue-600 dark:text-blue-400': {{ $model }} === '{{ $value }}',
    'border-transparent dark:border-slate-700 text-gray-500 dark:text-slate-300 hover:text-gray-700 dark:hover:text-slate-100 bg-gray-50 dark:bg-slate-800': {{ $model }} !== '{{ $value }}'
  }"
  @click="{{ $model }} = '{{ $value }}'"
>
  <x-dynamic-component 
    :component="'ui.icons.' . $icon"
  />
  {{ $slot }}
</div>

