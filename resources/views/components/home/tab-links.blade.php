@props([
  'tab'
])

<div class="mb-4 flex border-b border-gray-200 dark:border-slate-700">
  <a 
    href="{{ request()->url() }}?tab=personal-feed&sort=recent" 
    class="px-4 py-2 -mb-px border-b-2 text-sm transition-colors flex items-center gap-2
      {{ $tab === 'personal-feed' 
          ? 'border-blue-600 dark:border-blue-500 font-medium text-blue-600 dark:text-blue-500' 
          : 'border-transparent hover:border-gray-300 dark:hover:border-slate-400 text-gray-400 dark:text-slate-500 hover:text-gray-600 dark:hover:text-slate-400' }}"
  >
    <x-ui.icons.users stroke="{{ $tab === 'personal-feed' ? '1.5' : '1'}}"/>
    <span>Seguindo</span>
  </a>

  <a 
    href="{{ request()->url() }}?tab=trending-feed&sort=popular" 
    class="px-4 py-2 -mb-px border-b-2 text-sm transition-colors flex items-center gap-2
      {{ $tab === 'trending-feed' 
          ? 'border-blue-600 dark:border-blue-500 font-medium text-blue-600 dark:text-blue-500' 
          : 'border-transparent hover:border-gray-300 dark:hover:border-slate-400 text-gray-400 dark:text-slate-500 hover:text-gray-600 dark:hover:text-slate-400' }}"
  >
    <x-ui.icons.world stroke="{{ $tab === 'trending-feed' ? '1.5' : '1'}}"/>
    <span>Em alta</span>
  </a>
</div>