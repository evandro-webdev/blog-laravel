<div x-show="tab === 'posts'">
  <x-ui.panel>
    <div class="space-y-1 mb-6">
      <h3 class="text-2xl font-bold text-gray-900">Posts publicados</h3>
      <p class="text-sm text-gray-700">Sua ultimas atividades no blog</p>
    </div>
    
    <x-blog.dashboard.tabs.posts.table :$posts/>
  </x-ui.panel>
</div>