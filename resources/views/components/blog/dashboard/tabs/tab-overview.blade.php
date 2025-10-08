<div x-show="tab === 'overview'" class="space-y-2">
  <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-4">
    <x-blog.dashboard.statistic-panel label="Publicações" icon="doc" :statistic="$statistics['posts']"/>
    <x-blog.dashboard.statistic-panel label="Visualizações" icon="eye" :statistic="$statistics['views']"/>
    <x-blog.dashboard.statistic-panel label="Comentários" icon="chart-bar" :statistic="$statistics['comments']"/>
    <x-blog.dashboard.statistic-panel label="Seguidores" icon="users" :statistic="$statistics['followers']"/>
  </div>

  <div class="flex flex-col md:flex-row gap-2">
    <x-ui.base.panel class="flex-1">
      <x-section-heading
        title="Posts mais vistos"
        desc="Confira quais dos seus posts estão sendo mais visualizados"
        class="mb-6"
      />

      <x-blog.dashboard.tabs.overview.trending-posts :posts="$mostViewedPosts"/>
    </x-ui.base.panel>

    <x-ui.base.panel class="flex-1">
      <x-section-heading
        title="Posts mais comentados"
        desc="Confira seus posts mais comentados"
        class="mb-6"
      />

      <x-blog.dashboard.tabs.overview.trending-posts :posts="$mostCommentedPosts"/>
    </x-ui.base.panel>
  </div>
</div>