@props([
  'action',
  'icon',
  'text',
  'class' => ''
])

<button
  @click="{{ $action }}"
  class="w-full px-3 py-2 text-left transition-colors flex items-center gap-2 {{ $class }}"
>
  <x-dynamic-component
    :component="'ui.icons.' . $icon"
    class="w-4 h-4"
  />
  <span class="font-medium text-sm">{{ $text }}</span>
</button>