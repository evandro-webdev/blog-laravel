@props([
  'variant' => 'default',
  'size' => 'md',
  'href' => null,
  'outline' => false,
  'type' => 'submit',
  'icon' => null
])

@php
  $iconUrl = asset('images/icons' . '/' . $icon . '.svg');

  $baseClasses = 'rounded-md font-medium cursor-pointer block text-center flex items-center justify-center gap-2 transition-colors duration-200';

  $sizeStyles = [
    'xs' => 'px-2 py-1 text-xs',
    'sm' => 'px-3 py-1.5 text-sm',
    'md' => 'px-6 py-2 text-base',
    'lg' => 'px-8 py-3 text-lg',
    'xl' => 'px-10 py-4 text-xl'
  ];

  $variantStyles = [
    'default' => [
      'filled' => 'border border-blue-600 bg-blue-600 text-white hover:bg-blue-700',
      'outline' => 'border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white'
    ],
    'success' => [
      'filled' => 'border border-green-600 bg-green-600 text-white hover:bg-green-700',
      'outline' => 'border border-green-600 text-green-600 hover:bg-green-600 hover:text-white'
    ],
    'danger' => [
      'filled' => 'border border-red-600 bg-red-600 text-white hover:bg-red-700',
      'outline' => 'border border-red-600 text-red-600 hover:bg-red-600 hover:text-white'
    ],
    'neutral' => [
      'filled' => 'border border-gray-600 bg-gray-600 text-white hover:bg-gray-700',
      'outline' => 'border border-gray-600 text-gray-900 dark:text-gray-100 hover:text-white hover:bg-gray-800 hover:border-gray-900'
    ]
  ];

  $sizeClasses = $sizeStyles[$size] ?? $sizeStyles['md'];
  $variantClasses = $variantStyles[$variant][$outline ? 'outline' : 'filled'] ?? '';

  $classes = implode(' ', [$baseClasses, $sizeClasses, $variantClasses]);
@endphp

@if ($href)
  <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    @if ($icon)
      <x-dynamic-component 
        :component="'ui.icons.' . $icon"
        :stroke="1.5"
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
      />
    @endif
    <span>{{ $slot }}</span>
  </button>
@endif