@props([
  'routeName',
  'label',
  'icon'
])

@php
  $isActive = Route::currentRouteNamed($routeName);

  $activeClass = $isActive 
    ? 'text-gray-700 dark:text-white bg-gray-100 dark:bg-slate-700' 
    : 'text-gray-600 dark:text-white hover:bg-gray-100 dark:hover:bg-slate-700';
@endphp

<li>
  <a href="{{ route($routeName) }}" class="{{ $activeClass }} flex items-center p-1 rounded-lg">
    <x-dynamic-component :component="'ui.icons.'.$icon" size="w-5 h-5 md:w-6 md:h-6"/>
    <span 
      x-show="dashboardMenuOpen || isLg"
      class="ms-3 whitespace-nowrap"
    >
      {{ $label }}
    </span>
  </a>
</li>