@props([
  'routeName',
  'label',
  'icon'
])

@php
  $isActive = Route::currentRouteNamed($routeName);

  $activeClass = $isActive 
    ? 'text-gray-700 dark:text-white bg-gray-100' 
    : 'text-gray-600 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700';
@endphp

<li>
  <a 
    href="{{ route($routeName) }}" 
    class="{{ $activeClass }} flex items-center p-2 rounded-lg group"
  >
    <x-dynamic-component :component="'ui.icons.'.$icon" size="w-6 h-6" class="text-inherit"/>
    <span class="ms-3">{{ $label }}</span>
  </a>
</li>