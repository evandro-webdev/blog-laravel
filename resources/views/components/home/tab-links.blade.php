@props([
  'tab'
])

@php
  $activeClass = 'border-blue-600 dark:border-blue-400 text-blue-600 dark:text-blue-400';
  $inactiveClass = 'border-transparent hover:border-gray-400 dark:hover:border-slate-500 text-gray-400 dark:text-slate-400 hover:text-gray-500 dark:hover:text-slate-300';
@endphp

<div class="mb-4 border-b border-gray-200 dark:border-slate-700 flex">
  <a 
    href="{{ request()->url() }}?tab=personal-feed&sort=recent" 
    class="px-4 py-2 font-medium border-b-2 transition-colors flex flex-1 justify-center items-center gap-2
      {{ $tab === 'personal-feed' 
          ?  $activeClass
          :  $inactiveClass
      }}"
  >
    <x-ui.icons.users/>
    <span>Seguindo</span>
  </a>

  <a 
    href="{{ request()->url() }}?tab=trending-feed&sort=popular" 
    class="px-4 py-2 font-medium border-b-2 transition-colors flex flex-1 justify-center items-center gap-2
      {{ $tab === 'trending-feed' 
          ?  $activeClass
          :  $inactiveClass
      }}"
    >
    <x-ui.icons.world/>
    <span>Em alta</span>
  </a>
</div>