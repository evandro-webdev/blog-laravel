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
  <a href="{{ route($routeName) }}" class="{{ $activeClass }} flex items-center p-1 rounded-lg">
    <x-dynamic-component :component="'ui.icons.'.$icon" size="w-5 h-5"/>
    <span class="ms-3 whitespace-nowrap" x-show="dashboardMenuOpen">{{ $label }}</span>
  </a>
</li>