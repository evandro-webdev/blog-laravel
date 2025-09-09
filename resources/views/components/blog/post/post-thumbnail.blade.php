@props([
  'link',      
  'showBadge' => false,
  'category' => null,
])

@php
  $containerClasses = 'shrink-0 relative overflow-hidden';
@endphp

<div {{ $attributes->merge(['class' => $containerClasses]) }}>
  <img 
    src="{{ $link }}" 
    class="w-full h-full object-cover" 
    alt="{{ $attributes->get('alt', 'Imagem') }}" 
    loading="lazy"
  >

  @if($showBadge && $category)
    <x-ui.badge 
      href="#" 
      class="absolute top-4 left-4"
      small
      variant="blue"
    >
      {{ $category->name }}
    </x-ui.badge>
  @endif
</div>
