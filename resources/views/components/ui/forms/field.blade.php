@props([
  'label',
  'name',
  'icon' => false,
  'tip' => null,
  'xError' => null
])

<div class="relative flex-1">
  @if ($label)
    <x-ui.forms.label :id="$name" :$label/>
  @endif

  @if ($icon)
    <x-dynamic-component 
      :component="'ui.icons.' . $icon"
      class="text-blue-600 dark:text-blue-400 absolute transform -translate-y-1/2 left-3 top-1/2"
    />
  @endif

  <div>
    {{ $slot }}

    @if ($tip)
      <x-ui.forms.field-tip :$tip />
    @endif

    <!-- Erro do backend -->
    <x-ui.forms.error :error="$errors->first($name)"/>
    
    <!-- Erro do frontend -->
    @if($xError)
      <x-ui.forms.error x-show="{{ $xError }}" x-text="{{ $xError }}" />
    @endif
  </div>
</div>