@extends('dashboard.layout')

@section('content')
  <x-page-heading 
    title="Atividade" 
    subtitle="Veja sua atividade recente"
  />

  <x-dashboard.tabs.tab-activity :activities="$activitiesData['activities']" :groupedActivities="$activitiesData['groupedActivities']"/>
@endsection