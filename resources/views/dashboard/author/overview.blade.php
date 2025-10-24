@extends('dashboard.layout')

@section('content')
  <x-page-heading 
    title="Visão geral" 
    subtitle="Gerencie o conteúdo do seu blog e veja estatísticas."
  />

  <x-ui.layout.tab-container default-tab="overview" class="space-y-2">
    <x-slot:tabs>
      <x-ui.tab value="overview" x-model="tab" icon="doc-search">Visão geral</x-ui.tab>
      <x-ui.tab value="something" x-model="tab" icon="doc-search">Alguma coisa</x-ui.tab>
    </x-slot:tabs>

    <x-slot:content>
      <x-dashboard.tabs.tab-overview 
        :statistics="$dashboardData['statistics']" 
        :mostViewedPosts="$dashboardData['mostViewedPosts']"
        :mostCommentedPosts="$dashboardData['mostCommentedPosts']"
      />
    </x-slot:content>
  </x-ui.tab-container>
@endsection