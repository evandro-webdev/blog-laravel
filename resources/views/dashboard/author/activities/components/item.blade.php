@props(['activity'])

@php
  $map = [
    'Post publicado' => [
      'icon'  => 'doc-plus',
      'color' => 'text-green-600 dark:text-green-500',
      'bg'    => 'group-hover:border-green-300 dark:group-hover:border-green-700 bg-green-50 dark:bg-green-900/70',
    ],
    'Post atualizado' => [
      'icon'  => 'edit',
      'color' => 'text-blue-600 dark:text-blue-500',
      'bg'    => 'group-hover:border-blue-400 dark:group-hover:border-blue-600 bg-blue-50 dark:bg-blue-900/70',
    ],
    'Post deletado' => [
      'icon'  => 'trash',
      'color' => 'text-red-600 dark:text-red-500',
      'bg'    => 'group-hover:border-red-300 dark:group-hover:border-red-700 bg-red-50 dark:bg-red-900/70',
    ],
  ];

  $data = $map[$activity->action] ?? [
    'icon'  => 'doc',
    'color' => 'text-gray-600 dark:text-gray-300',
    'bg'    => 'bg-gray-100 dark:bg-gray-800',
  ];

@endphp

<div class="p-2 cursor-pointer rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 flex items-center gap-3 group transition-colors">
  <div class="w-9 h-9 rounded-full border border-transparent {{ $data['bg'] }} flex justify-center items-center transition-colors">
    <x-dynamic-component 
      :component="'ui.icons.' . $data['icon']"
      class="{{ $data['color'] }}"
    />
  </div>
  
  <div class="flex-1 min-w-0">
    <h4 class="text-sm font-semibold text-gray-700 dark:text-white">{{ $activity->action }}</h4>

    @if ($activity->subject_url)
      <a href="{{$activity->subject_url}}" class="block text-xs truncate whitespace-nowrap overflow-hidden text-gray-500 dark:text-gray-300">
        {{ $activity->description }}
      </a>
    @else
      <p class="text-xs truncate whitespace-nowrap overflow-hidden text-gray-500 dark:text-gray-300">
        {{ $activity->description }}
      </p>
    @endif
  </div>
</div>