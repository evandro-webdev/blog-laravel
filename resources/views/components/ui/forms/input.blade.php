@props([
  'label' => false,
  'name',
  'type' => 'text',
  'id' => $name,
  'value' => old($name),
  'as' => 'input',
  'variant' => 'default',
  'icon' => false,
  'tip' => null,
  'xError' => null
])

@php
  $baseClasses = 'w-full p-3 border rounded-md text-gray-800 outline-none bg-white transition-colors block resize-none';

  $variantClasses = [
    'default' => 'border-gray-300 focus:border-gray-500 focus:ring-1 focus:ring-gray-500',
    'blue' => 'border-blue-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500',
  ][$variant];

  $iconPadding = $icon ? ' pl-10' : '';

  $inputClasses = implode(' ', [
    $baseClasses,
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
