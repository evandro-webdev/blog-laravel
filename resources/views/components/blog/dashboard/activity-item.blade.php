@props(['activity'])

@php
  $map = [
    'Post publicado' => ['icon' => 'doc-plus-green.svg', 'bg' => 'bg-green-50'],
    'Post atualizado' => ['icon' => 'edit-blue.svg', 'bg' => 'bg-blue-50'],
    'Post deletado'   => ['icon' => 'trash-red.svg', 'bg' => 'bg-red-50'],
  ];

  $data = $map[$activity->action] ?? ['icon' => 'doc-blue.svg', 'bg' => 'bg-gray-100'];
@endphp

<div class="flex items-center gap-3">
  <div class="w-8 p-2 rounded-full {{ $data['bg'] }}">
    <img src="{{ asset('images/icons/' . $data['icon']) }}" alt="">
  </div>
  
  <div class="flex-1 min-w-0">
    <h4 class="text-sm font-bold text-gray-800"><a href="#">{{ $activity->action }}</a></h4>
    <p class="text-sm truncate whitespace-nowrap overflow-hidden text-gray-700">
      {{ $activity->description }}
    </p>
  </div>
</div>