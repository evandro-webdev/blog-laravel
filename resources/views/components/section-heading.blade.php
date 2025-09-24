@props([
  'title',
  'desc' => null,
  'link' => false,
  'size' => 'md',
])

@php
  $sizes = [
    'sm' => ['title' => 'text-lg',  'desc' => 'text-xs', 'link' => 'text-xs'],
    'md' => ['title' => 'text-2xl', 'desc' => 'text-sm', 'link' => 'text-sm'],
    'lg' => ['title' => 'text-4xl', 'desc' => 'text-base', 'link' => 'text-base'],
  ];

  $class = $link ? 'flex items-center justify-between' : '';
@endphp

<div {{ $attributes->merge(['class' => $class]) }}>
  <div class="space-y-1">
    <h2 class="{{ $sizes[$size]['title'] }} font-bold text-gray-900 dark:text-white">
      {{ $title }}
    </h2>

    @if ($desc)
      <p class="{{ $sizes[$size]['desc'] }} text-gray-700 dark:text-gray-100">
        {{ $desc }}
      </p>
    @endif
  </div>
  
  @if ($link)
    <a href="{{ $link }}" class="{{ $sizes[$size]['link'] }} font-medium text-gray-700 dark:text-white">
      Ver todos →
    </a>
  @endif
</div>
