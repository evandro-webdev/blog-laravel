<div x-show="tab === 'overview'" class="space-y-2">
  <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-4">
    <x-ui.panel class="space-y-4 hover:bg-gray-50">
      <div class="flex justify-between">
        <span class="font-medium text-gray-900">Total Posts</span>
        <x-ui.icons.doc class="text-blue-600"/>
      </div>
      <div>
        <span class="text-3xl font-bold text-gray-800">{{ $statistics['totalPosts'] }}</span>
        <p class="text-sm text-gray-700">+{{ $statistics['publishedLast30Days'] }} no ultimo mês</p>
      </div>
    </x-ui.panel>
    
    <x-ui.panel class="space-y-4 hover:bg-gray-50">
      <div class="flex justify-between">
        <span class="font-medium text-gray-900">Total Views</span>
        <x-ui.icons.eye class="text-blue-600"/>
      </div>
      <div>
        <span class="text-3xl font-bold text-gray-800">{{ $statistics['totalViews'] }}</span>
        <p class="text-sm text-gray-700">+18% no ultimo mês</p>
      </div>
    </x-ui.panel>

    <x-ui.panel class="space-y-4 hover:bg-gray-50">
      <div class="flex justify-between">
        <span class="font-medium text-gray-900">Inscrições</span>
        <x-ui.icons.users class="text-blue-600"/>
      </div>
      <div>
        <span class="text-3xl font-bold text-gray-800">573</span>
        <p class="text-sm text-gray-700">+38 nesse mês</p>
      </div>
    </x-ui.panel>

    <x-ui.panel class="space-y-4 hover:bg-gray-50">
      <div class="flex justify-between">
        <span class="font-medium text-gray-900">Engajamento</span>
        <x-ui.icons.arrow-trending class="text-blue-600"/>
      </div>
      <div>
        <span class="text-3xl font-bold text-gray-800">12.4K</span>
        <p class="text-sm text-gray-700">+18% no ultimo mês</p>
      </div>
    </x-ui.panel>
  </div>

  <x-ui.panel>
    <div class="space-y-1 mb-6">
      <h3 class="text-2xl font-bold text-gray-900">Atividades recentes</h3>
      <p class="text-sm text-gray-700">Sua ultimas atividades no blog</p>
    </div>
    <div class="space-y-4">
      @foreach ($groupedActivities as $label => $activityGroup)
        <h3 class="font-medium text-gray-800">{{ $label }}</h3>
        @foreach ($activityGroup as $activity)
          <x-blog.dashboard.tabs.overview.activity-item :$activity/>
        @endforeach
        <hr class="text-gray-200">
      @endforeach

      {{ $activities->appends(['tab' => 'overview'])->links() }}
    </div>
  </x-ui.panel>

  <x-ui.panel class="w-1/2">
    @php
      $maxCount = $popularCategories->max('posts_count');
    @endphp
    <h3 class="mb-4 text-2xl font-bold text-gray-900">Popular Categories</h3>

    <ul class="space-y-4">
      @foreach ($popularCategories as $category)
        @php
          $percentage = $maxCount > 0 ? ($category->posts_count / $maxCount) * 100 : 0;
        @endphp

        <li>
          <div class="flex justify-between text-sm mb-1">
            <h2 class="font-bold text-gray-800">{{ $category->name }}</h2>
            <span class="font-medium text-gray-500">{{ $category->posts_count }} posts</span>
          </div>

          <div class="w-full bg-gray-200 rounded h-2">
            <div class="bg-blue-600 h-2 rounded" style="width: {{ $percentage }}%"></div>
          </div>
        </li>
      @endforeach
    </ul>
  </x-ui.panel>
</div>