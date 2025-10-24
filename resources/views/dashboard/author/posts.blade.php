@extends('dashboard.layout')

@section('content')
  <x-page-heading 
    title="Posts" 
    subtitle="Gerencie os seus posts"
  />

  <x-ui.layout.tab-container default-tab="posts" class="space-y-2">
    <x-slot:tabs>
      <x-ui.tab value="posts" x-model="tab" icon="doc-search">Todos</x-ui.tab>
      <x-ui.tab value="most-viewed" x-model="tab" icon="doc-search">Mais vistos</x-ui.tab>
      <x-ui.tab value="most-commented" x-model="tab" icon="doc-search">Mais comentados</x-ui.tab>
    </x-slot:tabs>

    <x-slot:content>
      <x-dashboard.tabs.tab-posts :$posts />
    </x-slot:content>
  </x-ui.tab-container>
@endsection