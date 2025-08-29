<div x-show="tab === 'read'" class="space-y-6">
  <x-ui.panel>
    <h2 class="text-2xl font-bold text-gray-800">Seus posts lidos</h2>

    <div class="space-y-2">
      @foreach ($user->readPosts as $post)
        <div class="py-4 border-b-1 space-y-1 border-b-gray-200">
          <h3 class="text-gray-800">{{ $post->title }}</h3>
          <time datetime="{{ $post->pivot->created_at }}" class="block text-sm text-gray-500">
            Lido em {{ $post->pivot->created_at->translatedFormat('d \d\e F, Y') }}
          </time>
        </div>
      @endforeach
    </div>
  </x-ui.panel> 
</div>