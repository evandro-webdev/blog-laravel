@props([
  'tone' => 'default'
])

@php
  $baseClasses = 'p-6 rounded-xl border border-gray-200 bg-white transition-colors duration-300';

  $variants = [
    'default' => 'dark:border-transparent dark:bg-slate-700',
    'darker' => 'dark:border-transparent dark:bg-slate-800',
    'darkest' => 'dark:border-transparent dark:bg-slate-900',
  ];

  $classes = "$baseClasses " . ($variants[$tone] ?? $variants['default']);
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
  {{ $slot }}
</div>