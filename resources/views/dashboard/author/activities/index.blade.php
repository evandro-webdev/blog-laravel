@extends('dashboard.layout')

@section('content')
  <x-page-heading 
    title="Atividade" 
    subtitle="Veja sua atividade recente"
  />

  <x-ui.base.panel tone="darker">
    <div class="space-y-4">
      @if($activitiesData['activities']->count() > 0)
        @foreach ($activitiesData['groupedActivities'] as $label => $activityGroup)
          <div class="space-y-2 pb-4 border-b-1 border-b-gray-200 dark:border-b-gray-700 last:border-b-0">
            <h3 class="font-medium text-gray-800 dark:text-white">{{ $label }}</h3>
            @foreach ($activityGroup as $activity)
              @include('dashboard.author.activities.components.item', ['activity' => $activity])
            @endforeach
          </div>
        @endforeach

        {{ $activitiesData['activities']->links() }}
      @else
        <x-ui.utilities.message message="Você não possui nenhuma atividade recente"/>
      @endif
    </div>
  </x-ui.base.panel>
@endsection