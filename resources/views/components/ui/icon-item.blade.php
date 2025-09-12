@props([
  'icon',
  'label',
  'value' => null,
  'iconClass' => 'w-5 h-5',
  'labelClass' => 'text-sm',
  'valueClass' => 'font-bold',
  'stroke' => '1.5'
])

<div {{ $attributes->merge(['class' =>  'flex items-center justify-between text-gray-600 dark:text-gray-300']) }}>
  <div class="flex items-center gap-2">
    <x-dynamic-component 
      :component="'ui.icons.' . $icon"
      class="{{ $iconClass }}"
      :stroke="$stroke"
    />
    <span class="{{ $labelClass }}">{{ $label }}</span>
  </div>
  @if ($value)
    <span class="{{ $valueClass }}">{{ $value }}</span>
  @endif
</div>