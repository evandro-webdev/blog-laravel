@props([
  'defaultTab'
])

<div 
  x-data="{
    tab: (new URLSearchParams(window.location.search)).get('tab') || '{{ $defaultTab }}',
    updateUrl() {
      const url = new URL(window.location);
      url.searchParams.set('tab', this.tab);
      window.history.replaceState({}, '', url);
    }
  }"
  x-init="updateUrl()"
  x-effect="updateUrl()"
  {{ $attributes->merge(['class' => 'flex-1']) }}
>
  <div class="flex gap-1">
    {{ $tabs }}
  </div>

  @isset($middle)
    <div>
      {{ $middle }}
    </div>
  @endisset
      
  <div>
    {{ $content }}
  </div>
</div>