<div x-show="tab === 'overview'" class="space-y-2">
  <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-4">
    <x-ui.panel class="space-y-4 hover:bg-gray-50 dark:hover:bg-gray-950">
      <div class="flex justify-between">
        <span class="font-medium text-gray-900 dark:text-white">Total Posts</span>
        <x-ui.icons.doc class="text-blue-600 dark:text-blue-500"/>
      </div>
      <div>
        <span class="text-3xl font-bold text-gray-800 dark:text-white">{{ $statistics['totalPosts'] }}</span>
        <p class="text-sm text-gray-700 dark:text-gray-200">+{{ $statistics['publishedLast30Days'] }} no ultimo mês</p>
      </div>
    </x-ui.panel>
    
    <x-ui.panel class="space-y-4 hover:bg-gray-50 dark:hover:bg-gray-950">
      <div class="flex justify-between">
        <span class="font-medium text-gray-900 dark:text-white">Total Views</span>
        <x-ui.icons.eye class="text-blue-600 dark:text-blue-500"/>
      </div>
      <div>
        <span class="text-3xl font-bold text-gray-800 dark:text-white">{{ $statistics['totalViews'] }}</span>
        <p class="text-sm text-gray-700 dark:text-gray-200">+18% no ultimo mês</p>
      </div>
    </x-ui.panel>

    <x-ui.panel class="space-y-4 hover:bg-gray-50 dark:hover:bg-gray-950">
      <div class="flex justify-between">
        <span class="font-medium text-gray-900 dark:text-white">Inscrições</span>
        <x-ui.icons.users class="text-blue-600 dark:text-blue-500"/>
      </div>
      <div>
        <span class="text-3xl font-bold text-gray-800 dark:text-white">573</span>
        <p class="text-sm text-gray-700 dark:text-gray-200">+38 nesse mês</p>
      </div>
    </x-ui.panel>

    <x-ui.panel class="space-y-4 hover:bg-gray-50 dark:hover:bg-gray-950">
      <div class="flex justify-between">
        <span class="font-medium text-gray-900 dark:text-white">Engajamento</span>
        <x-ui.icons.arrow-trending class="text-blue-600 dark:text-blue-500"/>
      </div>
      <div>
        <span class="text-3xl font-bold text-gray-800 dark:text-white">12.4K</span>
        <p class="text-sm text-gray-700 dark:text-gray-200">+18% no ultimo mês</p>
      </div>
    </x-ui.panel>
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

  <x-ui.panel class="w-1/2">
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
  </x-ui.panel>
</div>