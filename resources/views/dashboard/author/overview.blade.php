@extends('dashboard.layout')

@section('content')
  <x-page-heading 
    title="Visão geral" 
    subtitle="Gerencie o conteúdo do seu blog e veja estatísticas."
  />

  <div class="space-y-2">
    <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-4">
      <x-dashboard.panels.statistic label="Publicações" icon="doc" :statistic="$overviewData['statistics']['posts']"/>
      <x-dashboard.panels.statistic label="Visualizações" icon="eye" :statistic="$overviewData['statistics']['views']"/>
      <x-dashboard.panels.statistic label="Comentários" icon="chart-bar" :statistic="$overviewData['statistics']['comments']"/>
      <x-dashboard.panels.statistic label="Seguidores" icon="users" :statistic="$overviewData['statistics']['followers']"/>
    </div>

    <div class="flex flex-col lg:flex-row gap-2">
      <x-ui.base.panel class="flex-1" tone="darker">
        <x-section-heading
          title="Posts mais vistos"
          desc="Confira seus posts mais visualizados"
          class="mb-8"
        />

        <x-dashboard.panels.list-posts :posts="$overviewData['mostViewedPosts']"/>
      </x-ui.base.panel>

      <x-ui.base.panel class="flex-1" tone="darker">
        <x-section-heading
          title="Posts mais comentados"
          desc="Confira seus posts mais comentados"
          class="mb-8"
        />

        <x-dashboard.panels.list-posts :posts="$overviewData['mostCommentedPosts']"/>
      </x-ui.base.panel>
    </div>
  </div>
@endsection