@props([
  'icon' => null,
  'position' => 'center-bottom',
])

@php
  $iconUrl = asset('images/icons' . '/' . $icon . '.svg');

  $positions = [
    'right-top'    => 'top-5 right-5',
    'right-bottom' => 'bottom-5 right-5',
    'left-top'     => 'top-5 left-5',
    'left-bottom'  => 'bottom-5 left-5',
    'center-top'   => 'top-5 left-1/2 transform -translate-x-1/2',
    'center-bottom'=> 'bottom-5 left-1/2 transform -translate-x-1/2',
  ];

  $positionClass = $positions[$position];
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
  class="w-full max-w-xs p-4 rounded-lg fixed {{ $positionClass }} text-gray-500 dark:text-white bg-white dark:bg-gray-800 shadow-sm
        flex items-center justify-between z-50" 
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
    class="h-8 w-8 p-1.5 rounded-lg focus:ring-2 focus:ring-gray-300 bg-white dark:bg-gray-900 
        hover:bg-gray-100 dark:hover:bg-gray-700 inline-flex items-center justify-center transition-colors" 
    data-dismiss-target="#toast"
    aria-label="Fechar"
    @click="show=false"
  >
    <span class="sr-only">Fechar</span>
    <x-ui.icons.close class="text-blue-600 dark:text-blue-400"/>
  </button>
</div>