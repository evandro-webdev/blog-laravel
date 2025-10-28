<div x-show="tab === 'all'">
  <x-ui.base.panel tone="darker">
    <x-section-heading
      title="Meus posts"
      desc="Gerencie seus posts"
      class="mb-6"
    />
    
    @if ($posts->count() > 0)
      @include('dashboard.author.posts.components.table', ['posts' => $posts])
    @else
      <x-ui.utilities.message message="Você não possui nenhum post, comece a publicar agora mesmo"/>
    @endif
  </x-ui.base.panel>
</div>