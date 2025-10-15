@props(['value', 'icon'])

@php
  $model = $attributes->get('x-model');
@endphp

<div
  class="px-1 py-2 lg:py-3 rounded-lg border text-sm lg:text-base font-medium text-center cursor-pointer
         text-nowrap transition-colors flex-1 flex items-center justify-center gap-1 lg:gap-2"
  x-bind:class="{
    'border-gray-200 dark:border-transparent text-blue-600 dark:text-blue-400 bg-white dark:bg-slate-800': {{ $model }} === '{{ $value }}',
    'border-transparent hover:border-gray-200 dark:hover:border-transparent text-gray-500 dark:text-slate-300 hover:text-gray-600 dark:hover:text-slate-100 bg-gray-100 hover:bg-white dark:bg-slate-700 dark:hover:bg-slate-800': {{ $model }} !== '{{ $value }}'
  }"
  @click="{{ $model }} = '{{ $value }}'"
>
  <x-dynamic-component 
    :component="'ui.icons.' . $icon"
  />
  <span class="hidden sm:block">{{ $slot }}</span>
</div>

