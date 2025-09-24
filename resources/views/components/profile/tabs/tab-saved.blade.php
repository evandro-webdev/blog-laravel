<div x-show="tab === 'saved'" class="space-y-6">
  <x-ui.panel>
    <x-section-heading
      title="Posts salvos"
      desc="Confira seus posts preferidos ou salvos para ler mais tarde"
      class="mb-6"
    />

    <div class="space-y-4">
      @foreach ($user->savedPosts as $post)
        <div class="pb-4 space-y-1 border-b-1 border-b-gray-200 dark:border-b-gray-700 last:border-b-0 last:pb-0">
          <h3 class="text-gray-800 dark:text-white">{{ $post->title }}</h3>
          <div class="text-sm text-gray-500 dark:text-gray-300 flex gap-1">
            <span class="text-blue-500 dark:text-blue-400">{{ Str::ucfirst($post->category->name) }}</span>
            <span>•</span>
            <span>por {{ $post->user->name }}</span>
          </div>
        </div>
      @endforeach
    </div>
  </x-ui.panel> 
</div>