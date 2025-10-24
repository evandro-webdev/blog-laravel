@extends('dashboard.layout')

@section('content')
  <x-page-heading 
    title="Atividade" 
    subtitle="Veja sua atividade recente"
  />

  <x-dashboard.tabs.tab-activity :activities="$dashboardData['activities']" :groupedActivities="$dashboardData['groupedActivities']"/>
@endsection