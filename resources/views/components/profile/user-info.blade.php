@props([
  'user'
])

<x-ui.base.panel>
  <h3 class="mb-4 font-bold text-gray-800 dark:text-white">Sobre</h3>

  <div class="space-y-4">
    <p class="text-sm text-gray-800 dark:text-gray-100">{{ $user->bio }}</p>
    <div class="space-y-3">
      @if ($user->city)
        <x-ui.icon-with-text icon="local" label="{{ $user->city }}"/>
      @endif
      <x-ui.icon-with-text icon="calendar" label="Entrou em {{ $user->created_at->translatedFormat('d \d\e F, Y') }}"/>
    </div>

    @if ($user->socialProfiles->count() > 0) 
      <div class="flex gap-2">
        @foreach ($user->socialProfiles as $socialProfile)
          <x-ui.forms.button
            href="{{ $socialProfile->url }}"
            variant="neutral" 
            outline 
            size="sm"
          >
            {{ Str::ucfirst($socialProfile->provider) }}
          </x-ui.forms.button>
        @endforeach
      </div>
    @endif
  </div>
</x-ui.base.panel>