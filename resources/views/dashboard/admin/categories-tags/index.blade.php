@extends('dashboard.layout')

@section('content')
  <x-page-heading 
    title="Categorias e Tags" 
    subtitle="Gerencie o conteúdo do seu blog e veja estatísticas."
  />

  <x-ui.layout.tab-container default-tab="categories" class="space-y-2">
    <x-slot:tabs>
      <x-ui.tab value="categories" x-model="tab" icon="doc-search">Categorias</x-ui.tab>
      <x-ui.tab value="tags" x-model="tab" icon="doc-search">Tags</x-ui.tab>
    </x-slot:tabs>

    <x-slot:content>
      @include('dashboard.admin.categories-tags.tabs.categories', ['categoriesData' => $categoriesData])
      @include('dashboard.admin.categories-tags.tabs.tags', ['tagsData' => $tagsData])
    </x-slot:content>
  </x-ui.tab-container>

  <x-ui.toast/>
@endsection

<script src="{{ Vite::asset('resources/js/charts/chart.js') }}"></script>