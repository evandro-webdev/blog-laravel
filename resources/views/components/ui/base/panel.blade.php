@props(['border' => 'gray'])

@php
  $baseClasses = 'p-6 rounded-xl border bg-white dark:bg-slate-700 transition-colors duration-300';

  $borderClasses = [
    'gray' => 'border-gray-200 dark:border-slate-700',
    'blue' => 'border-blue-100 hover:bg-blue-50',
  ][$border];

  $classes = implode(' ', [
    $baseClasses,
    $borderClasses
]);
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
  {{ $slot }}
</div>