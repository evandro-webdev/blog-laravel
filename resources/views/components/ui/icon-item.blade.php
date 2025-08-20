@props([
  'icon',
  'label',
  'value',
  'iconClass' => '',
  'labelClass' => 'text-sm font-medium',
  'valueClass' => 'font-bold',
])

@php
  $iconUrl = asset('images/icons' . '/' . $icon . '.svg');
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center justify-between text-gray-800']) }}>
    <div class="flex items-center gap-2">
        <img src="{{ $iconUrl }}" class="{{ $iconClass }}" alt="{{ $label }}">
        <span class="{{ $labelClass }}">{{ $label }}</span>
    </div> 
    <span class="{{ $valueClass }}">{{ $value }}</span>
</div>