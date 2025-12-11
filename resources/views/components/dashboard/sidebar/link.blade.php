@props([
  'routeName',
  'label',
  'icon',
  'showLabel' => false
])

@php
  $isActive = Route::currentRouteNamed($routeName);

  $activeClass = $isActive 
    ? 'text-gray-700 dark:text-white bg-gray-100 dark:bg-slate-700' 
    : 'text-gray-600 dark:text-white hover:bg-gray-100 dark:hover:bg-slate-700';
@endphp

<li>
  <a 
    x-data
    href="{{ route($routeName) }}" 
    class="{{ $activeClass }} inline-flex md:flex items-center p-1 rounded-lg"
  >
    <x-dynamic-component :component="'ui.icons.'.$icon" size="w-5 h-5 md:w-6 md:h-6" class="text-inherit"/>
    <span
      class="ms-3 hidden md:block whitespace-nowrap"
      x-show="{{ $showLabel ? 'true' : 'false' }}"
      x-cloak
    >
      {{ $label }}
    </span>
  </a>
</li>