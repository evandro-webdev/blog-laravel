@props(['activity'])

@php
  $map = [
    'Post publicado' => ['icon' => 'doc-plus', 'color' => 'text-green-600', 'bg' => 'bg-green-50'],
    'Post atualizado' => ['icon' => 'edit', 'color' => 'text-blue-600', 'bg' => 'bg-blue-50'],
    'Post deletado'   => ['icon' => 'trash', 'color' => 'text-red-600', 'bg' => 'bg-red-50'],
  ];

  $data = $map[$activity->action] ?? ['icon' => 'doc', 'color' => 'text-gray-600', 'bg' => 'bg-gray-100'];
@endphp

<div class="flex items-center gap-3">
  <div class="w-9 h-9 rounded-full {{ $data['bg'] }} flex justify-center items-center">
    <x-dynamic-component 
      :component="'ui.icons.' . $data['icon']"
      class="{{ $data['color'] }}"
    />
  </div>
  
  <div class="flex-1 min-w-0">
    <h4 class="text-sm font-bold text-gray-800">{{ $activity->action }}</h4>

    @if ($activity->subject_url)
      <a href="{{$activity->subject_url}}" class="text-sm truncate whitespace-nowrap overflow-hidden text-gray-700">
        {{ $activity->description }}
      </a>
    @else
      <p class="text-sm truncate whitespace-nowrap overflow-hidden text-gray-700">
        {{ $activity->description }}
      </p>
    @endif
  </div>
</div>