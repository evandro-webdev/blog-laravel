@props([
  'icon' => null
])

@php
  $iconUrl = asset('images/icons' . '/' . $icon . '.svg');
@endphp

<div 
  x-data="{ show: false, message: ''}"
  @notify.window="
    message = $event.detail;
    show = true;
    setTimeout(() => show = false, 3000);
  "
  x-show="show"
  id="toast"
  class="w-full max-w-xs p-4 rounded-lg fixed bottom-5 right-5 flex items-center justify-between text-gray-500 bg-white shadow-sm" 
  role="alert"
  x-transition:enter="transform ease-out duration-300 transition"
  x-transition:enter-start="translate-y-2 opacity-0"
  x-transition:enter-end="translate-y-0 opacity-100"
  x-transition:leave="transform ease-in duration-200 transition"
  x-transition:leave-start="translate-y-0 opacity-100"
  x-transition:leave-end="translate-y-2 opacity-0"
>
  <div class="flex items-center">
    @if ($icon)
      <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-blue-500 bg-blue-100 rounded-lg">
        <img src="{{ $iconUrl }}" alt="Botão X de fechar">
      </div>
    @endif
  
    <div x-text="message" class="ms-3 text-sm font-normal"></div>
  </div>

  <button 
    type="button"
    class="h-8 w-8 p-1.5 rounded-lg focus:ring-2 focus:ring-gray-300  inline-flex items-center justify-center bg-white hover:bg-gray-100" 
    data-dismiss-target="#toast"
    aria-label="Fechar"
    @click="show=false"
  >
    <span class="sr-only">Fechar</span>
    <img src="{{ asset('images/icons/close-blue.svg') }}" alt="Botão X de fechar">
  </button>
</div>