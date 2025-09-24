<div x-show="tab === 'read'" class="space-y-6">
  <x-ui.panel>
    <x-section-heading
      title="Posts lidos"
      desc="Confira seus ultimos posts lidos"
      class="mb-6"
    />

    <div class="space-y-4">
      @foreach ($user->readPosts as $post)
        <div class="pb-4 border-b-1 space-y-1 border-b-gray-200 dark:border-b-gray-700 last:border-b-0 last:pb-0">
          <h3 class="text-gray-800 dark:text-white">{{ $post->title }}</h3>
          <time datetime="{{ $post->pivot->created_at }}" class="block text-sm text-gray-500 dark:text-gray-300">
            Lido em {{ $post->pivot->created_at->translatedFormat('d \d\e F, Y') }}
          </time>
        </div>
      @endforeach
    </div>
  </x-ui.panel> 
</div>