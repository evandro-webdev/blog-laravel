<div x-show="tab === 'overview'" class="space-y-2">
  <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-4">
    <x-blog.dashboard.statistic-panel label="Publicações" icon="doc" :statistic="$statistics['posts']"/>
    <x-blog.dashboard.statistic-panel label="Visualizações" icon="eye" :statistic="$statistics['views']"/>
    <x-blog.dashboard.statistic-panel label="Comentários" icon="chart-bar" :statistic="$statistics['comments']"/>
    <x-blog.dashboard.statistic-panel label="Seguidores" icon="users" :statistic="$statistics['followers']"/>
  </div>

  <div class="flex flex-col md:flex-row gap-2">
    <x-ui.panel class="flex-1">
      <x-section-heading
        title="Seus melhores posts"
        desc="Confira quais dos seus posts estão bombando"
        class="mb-8"
      />

      <div class="space-y-1">
        @foreach ($trendingPosts as $post)
          <a 
            href="{{ route('posts.show', $post) }}"
            class="p-2 rounded-md space-y-1 block hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
          >
            <h3 class="text-sm font-medium line-clamp-2 text-gray-700 dark:text-white">{{ $post->title }}</h3>
            <div class="text-xs text-gray-400 dark:text-gray-300 flex gap-2">
              <span class="text-nowrap">{{ $post->views->count() }} views</span>
              <span class="hidden sm:block">•</span>
              <span class="text-nowrap hidden sm:block">{{ $post->comments->count() }} comentários</span>
              <span>|</span>
              <time datetime="{{ $post->created_at }}" class="block text-nowrap">
                {{ $post->created_at->translatedFormat('d \d\e F, Y') }}
              </time>
            </div>
          </a>
        @endforeach
      </div>
    </x-ui.panel>

    <x-ui.panel class="flex-1">
      
    </x-ui.panel>
  </div>
</div>