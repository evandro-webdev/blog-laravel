@props([
  'title',
  'desc' => null,
  'link' => false,
  'size' => 'md',
])

@php
  $sizes = [
    'sm' => [
      'title' => 'text-base sm:text-lg',
      'desc'  => 'text-xs sm:text-sm',
      'link'  => 'text-xs sm:text-sm',
    ],
    'md' => [
      'title' => 'text-lg sm:text-xl lg:text-2xl',
      'desc'  => 'text-xs sm:text-sm',
      'link'  => 'text-sm',
    ],
    'lg' => [
      'title' => 'text-xl sm:text-2xl lg:text-4xl',
      'desc'  => 'text-sm sm:text-base',
      'link'  => 'text-sm sm:text-base',
    ],
  ];

  $class = $link ? 'flex items-center justify-between' : '';
@endphp

<div {{ $attributes->merge(['class' => $class]) }}>
  <div class="space-y-1">
    <h2 class="{{ $sizes[$size]['title'] }} font-bold text-gray-900 dark:text-white">
      {{ $title }}
    </h2>

    @if ($desc)
      <p class="{{ $sizes[$size]['desc'] }} text-gray-700 dark:text-gray-300">
        {{ $desc }}
      </p>
    @endif
  </div>
  
  @if ($link)
    <a href="{{ $link }}" class="{{ $sizes[$size]['link'] }} font-medium hover:underline text-gray-700 dark:text-white">
      Ver todos →
    </a>
  @endif
</div>
