@props([
  'image',
  'title',     
  'showBadge' => false,
  'category' => null
])

@php
  $containerClasses = 'aspect-video shrink-0 rounded-lg relative overflow-hidden';
@endphp

<div {{ $attributes->merge(['class' => $containerClasses]) }}>
  <img
    src="{{ asset('storage/' . $image) }}"
    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" 
    alt="Miniatura de: {{ $title }}"
    loading="lazy"
    onerror="this.onerror=null; this.src='{{ asset('storage/posts/placeholder.jpg') }}';"
  >

  @if($showBadge && $category)
    <x-ui.base.badge 
      href="#" 
      class="absolute top-4 left-4"
      small
      variant="blue"
    >
      {{ $category->name }}
    </x-ui.base.badge>
  @endif
</div>
