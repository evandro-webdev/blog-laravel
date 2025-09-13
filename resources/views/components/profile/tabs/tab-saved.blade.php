<div x-show="tab === 'saved'" class="space-y-6">
  <x-ui.panel>
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Seus posts salvos</h2>

    <div class="space-y-2">
      @foreach ($user->savedPosts as $post)
        <div class="py-4 border-b-1 space-y-1 border-b-gray-200 dark:border-b-gray-700 last:border-b-0">
          <h3 class="text-gray-800 dark:text-white">{{ $post->title }}</h3>
          <div class="text-sm text-gray-500 dark:text-gray-300 flex gap-1">
            <span class="text-blue-500">{{ Str::ucfirst($post->category->name) }}</span>
            <span>•</span>
            <span>por {{ $post->user->name }}</span>
          </div>
        </div>
      @endforeach
    </div>
  </x-ui.panel> 
</div>