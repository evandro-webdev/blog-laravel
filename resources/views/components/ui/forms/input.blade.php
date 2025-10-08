@props([
  'label' => false,
  'name',
  'type' => 'text',
  'id' => $name,
  'value' => old($name),
  'as' => 'input',
  'variant' => 'default',
  'size' => 'md',
  'icon' => false,
  'tip' => null,
  'xError' => null
])

@php
  $baseClasses = 'w-full rounded-lg text-sm placeholder-gray-400 outline-none transition-colors block resize-none focus:border-gray-500 focus:ring-1 focus:ring-gray-500';

  $variantClasses = [
    'default' => 'border border-gray-300 dark:border-slate-700 text-gray-800 dark:text-gray-100 bg-white dark:bg-slate-700',
    'white' => 'text-gray-700 bg-white'
  ][$variant];

  $sizeClasses = [
    'sm' => 'p-2 text-sm',
    'md' => 'p-3'
  ][$size];

  $iconPadding = $icon ? ' pl-10' : '';

  $inputClasses = implode(' ', [
    $baseClasses,
    $sizeClasses,
    $variantClasses,
    $iconPadding
  ]);
@endphp

<x-ui.forms.field 
  :$icon 
  :$label 
  :$name
  :$tip
  :x-error="$xError"
>
  @if ($as === 'textarea')
    <textarea 
      id="{{ $id }}"
      name="{{ $name }}"
      rows="4"
      {{ $attributes->except(['x-error'])->merge(['class' => $inputClasses]) }}
    >{!! $value !!}</textarea>
  @else
    <input 
      type="{{ $type }}"
      id="{{ $id }}"
      name="{{ $name }}"
      value="{{ $value }}"
      {{ $attributes->except(['x-error'])->merge(['class' => $inputClasses]) }}
    />
  @endif
</x-ui.forms.field>
