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
  <div class="p-1 rounded-md border-1 border-gray-200 bg-gray-50 grid grid-cols-2 md:grid-cols-4 gap-1">
    {{ $tabs }}
  </div>

      
  <div>
    {{ $content }}
  </div>
</div>