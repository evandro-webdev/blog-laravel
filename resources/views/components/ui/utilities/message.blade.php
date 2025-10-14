@props([
  'message',
  'type' => 'default',
  'icon' => 'info'
])

@php
  $variantStyles = [
    'default' => 'border border-gray-300 dark:border-0 text-gray-600 dark:text-gray-300 bg-gray-50 dark:bg-slate-600',
    'success' => 'text-green-600 dark:text-green-300 bg-green-50 dark:bg-green-950',
    'alert' => 'border border-yellow-200 dark:border-0 text-yellow-600 dark:text-yellow-300 bg-yellow-50 dark:bg-yellow-800',
    'danger' => 'text-red-600 dark:text-red-300 bg-red-100 dark:bg-red-950',
  ];

  $icons = [
    'default' => $icon,
    'success' => 'check',
    'alert' => 'alert',
    'danger' => 'danger',
  ];

  $classes = 'p-4 rounded-md flex items-center gap-2 ' . $variantStyles[$type];
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
  <x-dynamic-component :component="'ui.icons.' . $icons[$type]"/>
  <p>{{ $message }}</p>
</div>