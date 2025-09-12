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
  <div class="p-1 rounded-md border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 flex flex-wrap gap-1">
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