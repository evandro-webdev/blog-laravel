<div x-show="tab === 'activity'">
  <x-ui.base.panel>
    <x-section-heading
      title="Atividades recentes"
      desc="Suas ultimas atividades no blog:"
      class="mb-6"
    />

    <div class="space-y-4">
      @if($activities->count() > 0)
        @foreach ($groupedActivities as $label => $activityGroup)
          <div class="space-y-4 pb-4 border-b-1 border-b-gray-200 dark:border-b-gray-600 last:border-b-0">
            <h3 class="font-medium text-gray-800 dark:text-white">{{ $label }}</h3>
            @foreach ($activityGroup as $activity)
              <x-blog.dashboard.tabs.activity.activity-item :$activity/>
            @endforeach
          </div>
        @endforeach

        {{ $activities->appends(['tab' => 'activity'])->links() }}
      @else
        <x-ui.utilities.message message="Você não possui nenhuma atividade recente"/>
      @endif
    </div>
  </x-ui.base.panel>
</div>