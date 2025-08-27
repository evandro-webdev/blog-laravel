@props([
  'defaultTab' => 'overview'
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
  {{ $attributes->merge(['class']) }}
>
  <div class="p-1 rounded bg-gray-100 flex flex-wrap">
    {{ $tabs }}
  </div>
      
  <div class="mt-6">
    {{ $content }}
  </div>
</div>