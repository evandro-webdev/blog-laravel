<div x-show="tab === 'overview'" class="space-y-2">
  <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-4">
    <x-blog.dashboard.statistic-panel label="Publicações" icon="doc" :statistic="$statistics['posts']"/>
    <x-blog.dashboard.statistic-panel label="Visualizações" icon="eye" :statistic="$statistics['views']"/>
    <x-blog.dashboard.statistic-panel label="Engajamento" icon="chart-bar" :statistic="$statistics['comments']"/>
    <x-blog.dashboard.statistic-panel label="Seguidores" icon="users" :statistic="$statistics['followers']"/>
  </div>

  <x-ui.panel>
    <div class="space-y-1 mb-6">
      <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Atividades recentes</h3>
      <p class="text-sm text-gray-700 dark:text-gray-100">Sua ultimas atividades no blog</p>
    </div>
    <div class="space-y-4">
      @foreach ($groupedActivities as $label => $activityGroup)
        <h3 class="font-medium text-gray-800 dark:text-white">{{ $label }}</h3>
        @foreach ($activityGroup as $activity)
          <x-blog.dashboard.tabs.overview.activity-item :$activity/>
        @endforeach
        <hr class="text-gray-200 dark:text-gray-700">
      @endforeach

      {{ $activities->appends(['tab' => 'overview'])->links() }}
    </div>
  </x-ui.panel>

  {{-- <x-ui.panel class="w-1/2">
    @php
      $maxCount = $popularCategories->max('posts_count');
    @endphp
    <h3 class="mb-4 text-2xl font-bold text-gray-900 dark:text-white">Popular Categories</h3>

    <ul class="space-y-4">
      @foreach ($popularCategories as $category)
        @php
          $percentage = $maxCount > 0 ? ($category->posts_count / $maxCount) * 100 : 0;
        @endphp

        <li>
          <div class="flex justify-between text-sm mb-1">
            <h2 class="font-bold text-gray-800 dark:text-white">{{ $category->name }}</h2>
            <span class="font-medium text-gray-500 dark:text-gray-100">{{ $category->posts_count }} posts</span>
          </div>

          <div class="w-full bg-gray-200 dark:bg-gray-700 rounded h-2">
            <div class="bg-blue-600 h-2 rounded" style="width: {{ $percentage }}%"></div>
          </div>
        </li>
      @endforeach
    </ul>
  </x-ui.panel> --}}
</div>