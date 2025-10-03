@props([
  'date',
  'format' => 'human',
  'prefix' => null
])

@php
  $formattedDate = match($format) {
    'human' => $date->diffForHumans(),
    'exact' => $date->translatedFormat('d/m/Y H:i'),
    default => $date->translatedFormat($format),
  };
@endphp

<time
  title="{{ $date->translatedFormat('d/m/Y H:i') }}"
  datetime="{{ $date->toIso8601String() }}" 
  {{ $attributes->merge(['class']) }}
>
  {{ $prefix ? $prefix . ' ' : '' }}{{ $formattedDate }}
</time>