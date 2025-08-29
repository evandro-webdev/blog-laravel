<div x-show="tab === 'saved'" class="space-y-6">
  <x-ui.panel>
    <h2 class="text-2xl font-bold text-gray-800">Seus posts salvos</h2>

    <div class="space-y-2">
      @foreach ($user->savedPosts as $post)
        <div class="py-4 border-b-1 space-y-1 border-b-gray-200">
          <h3 class="text-gray-800">{{ $post->title }}</h3>
          <div class="text-sm text-gray-500 flex gap-1">
            <span class="text-blue-500">{{ Str::ucfirst($post->category->name) }}</span>
            <span>•</span>
            <span>por {{ $post->user->name }}</span>
          </div>
        </div>
      @endforeach
    </div>
  </x-ui.panel> 
</div>