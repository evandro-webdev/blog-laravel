<div x-show="tab === 'saved'" class="space-y-6">
  <x-ui.base.panel tone="darker">
    <x-section-heading
      title="Posts salvos"
      desc="Confira seus posts preferidos ou salvos para ler mais tarde"
      class="mb-6"
    />

    <div class="space-y-4">
      @forelse ($user->savedPosts as $savedPost)
        <div class="pb-4 space-y-1 border-b-1 border-b-gray-200 dark:border-b-gray-700 last:border-b-0 last:pb-0">
          <h3 class="text-gray-800 dark:text-white">{{ $savedPost->title }}</h3>
          <div class="text-sm text-gray-500 dark:text-gray-300 flex gap-1">
            <span class="text-blue-500 dark:text-blue-400">{{ Str::ucfirst($savedPost->category->name) }}</span>
            <span>•</span>
            <span>por {{ $savedPost->user->name }}</span>
          </div>
        </div>
      @empty
        <x-ui.utilities.message message="Você não possui nenhum post salvo."/>
      @endforelse
    </div>
  </x-ui.base.panel> 
</div>