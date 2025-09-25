<div x-show="tab === 'posts'">
  <x-ui.panel>
    <x-section-heading
      title="Meus posts"
      desc="Gerencie seus posts"
      class="mb-6"
    />
    
    <x-blog.dashboard.tabs.posts.table :$posts/>
  </x-ui.panel>
</div>