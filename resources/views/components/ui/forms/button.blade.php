@props([
  'type' => 'submit',
  'href' => null,
  'variant' => 'default',
  'size' => 'md',
  'outline' => false,
  'icon' => null
])

@php
  $baseClasses = 'rounded-lg border font-medium cursor-pointer block text-center flex items-center justify-center gap-2 transition-colors duration-200';

  $sizeStyles = [
    'xs' => 'px-2 py-1 text-xs',
    'sm' => 'px-3 py-1.5 text-sm',
    'md' => 'px-6 py-2 text-base',
    'lg' => 'px-8 py-3 text-lg',
    'xl' => 'px-10 py-4 text-xl'
  ];

  $variantStyles = [
    'default' => [
      'filled' => 'border-blue-600 bg-blue-600 text-white hover:bg-blue-700',
      'outline' => 'border-blue-400 text-blue-400 hover:bg-blue-600 hover:text-white'
    ],
    'success' => [
      'filled' => 'border-green-600 bg-green-600 text-white hover:bg-green-700',
      'outline' => 'border-green-600 dark:border-green-500 text-green-600 dark:text-green-500 hover:bg-green-600 hover:text-white'
    ],
    'danger' => [
      'filled' => 'border-red-600 dark:border-red-700 bg-red-600 dark:bg-red-700 text-white hover:bg-red-700 dark:hover:bg-red-800',
      'outline' => 'border-red-600 dark:border-red-500 text-red-600 dark:text-red-500 hover:bg-red-600 dark:hover:bg-red-700 hover:text-white'
    ],
    'neutral' => [
      'filled' => 'border-slate-600 dark:border-slate-600 text-white bg-slate-600 dark:bg-slate-600 hover:bg-slate-700 dark:hover:bg-slate-700',
      'outline' => 'border-slate-600 text-slate-800 dark:text-slate-100 hover:text-white hover:bg-slate-600 '
    ],
    'white' => [
      'filled' => 'border-white text-blue-600 bg-white hover:bg-gray-100',
      'outline' => 'border-white text-white hover:text-blue-600 hover:bg-white'
    ]
  ];

  $sizeClasses = $sizeStyles[$size];
  $variantClasses = $variantStyles[$variant][$outline ? 'outline' : 'filled'] ?? '';

  $classes = implode(' ', [$baseClasses, $sizeClasses, $variantClasses]);
@endphp

@if ($href)
  <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    @if ($icon)
      <x-dynamic-component
        :component="'ui.icons.' . $icon"
        :stroke="1.5"
        size="w-[1em] h-[1em]"
      />
    @endif
    <span>{{ $slot }}</span>
  </a>
@else
  <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    @if ($icon)
      <x-dynamic-component 
        :component="'ui.icons.' . $icon"
        :stroke="1.5"
        size="w-[1em] h-[1em]"
      />
    @endif
    <span>{{ $slot }}</span>
  </button>
@endif