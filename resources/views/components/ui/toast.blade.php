@props([
  'message' => session('message'),
  'icon' => null,
  'position' => 'center-bottom',
])

@php
  $positions = [
    'right-top'    => 'top-5 right-5',
    'right-bottom' => 'bottom-5 right-5',
    'left-top'     => 'top-5 left-5',
    'left-bottom'  => 'bottom-5 left-5',
    'center-top'   => 'top-5 left-1/2 transform -translate-x-1/2',
    'center-bottom'=> 'bottom-5 left-1/2 transform -translate-x-1/2',
  ];

  $positionClass = $positions[$position];
  $classes = "w-full max-w-xs p-4 rounded-lg fixed {{ $positionClass }} text-gray-500 dark:text-white 
              bg-white dark:bg-slate-700 shadow-sm flex items-center justify-between z-200" 
@endphp

<div 
  x-data="{ 
    show: false, 
    message: '',
    trigger(msg){
      this.message = msg;
      this.show = true;
      setTimeout(() => this.show = false, 3000);
    }
  }"
  x-init="
    @if ($message)
      setTimeout(() => trigger(@js($message)), 600);
    @endif

    window.addEventListener('notify', e => trigger(e.detail));
  "
  x-show="show"
  role="alert"
  aria-live="assertive"
  class="{{ $classes }}"
  x-transition:enter="transform ease-out duration-300 transition"
  x-transition:enter-start="translate-y-2 opacity-0"
  x-transition:enter-end="translate-y-0 opacity-100"
  x-transition:leave="transform ease-in duration-200 transition"
  x-transition:leave-start="translate-y-0 opacity-100"
  x-transition:leave-end="translate-y-2 opacity-0"
>
  <div class="flex items-center">
    @if ($icon)
      <x-dynamic-component :component="'ui.icons.' . $icon"/>
    @endif
  
    <div x-text="message" class="ms-3 text-sm font-normal"></div>
  </div>

  <button 
    type="button"
    class="h-8 w-8 p-1.5 rounded-lg focus:ring-2 focus:ring-gray-300 bg-white dark:bg-slate-800 
        hover:bg-gray-100 dark:hover:bg-slate-900 inline-flex items-center justify-center transition-colors" 
    data-dismiss-target="#toast"
    aria-label="Fechar"
    @click="show=false"
  >
    <x-ui.icons.close class="text-blue-600 dark:text-blue-400"/>
  </button>
</div>