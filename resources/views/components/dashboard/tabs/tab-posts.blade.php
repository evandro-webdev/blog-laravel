<div x-show="tab === 'posts'">
  <x-ui.base.panel tone="darker">
    <x-section-heading
      title="Meus posts"
      desc="Gerencie seus posts"
      class="mb-6"
    />
    
    @if ($posts->count() > 0)
      <x-dashboard.tabs.posts.table :$posts/>
    @else
      <x-ui.utilities.message message="Você não possui nenhum post, comece a publicar agora mesmo"/>
    @endif
  </x-ui.base.panel>
</div>