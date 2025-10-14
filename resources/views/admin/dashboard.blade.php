<x-layout class="dark:bg-slate-800">
  <div class="flex-1">
    <x-section>
      <div class="max-w-[1280px] mx-auto">
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
          <x-page-heading 
            title="Dashboard" 
            subtitle="Gerencie o conteúdo do seu blog e veja estatísticas."
          />
          <x-ui.forms.button href="/admin/posts/create">Novo post</x-ui.forms.button>
        </div>
        
        <x-ui.layout.tab-container default-tab="overview" class="space-y-2">
          <x-slot:tabs>
            <x-ui.tab value="overview" x-model="tab" icon="doc-search">Visão geral</x-ui.tab>
            <x-ui.tab value="posts" x-model="tab" icon="docs">Posts</x-ui.tab>
            <x-ui.tab value="activity" x-model="tab" icon="doc-list">Atividade</x-ui.tab>
          </x-slot:tabs>

          <x-slot:content>
            <x-blog.dashboard.tabs.tab-overview 
              :statistics="$dashboardData['statistics']" 
              :mostViewedPosts="$dashboardData['mostViewedPosts']"
              :mostCommentedPosts="$dashboardData['mostCommentedPosts']"
            />
            <x-blog.dashboard.tabs.tab-posts :posts="$dashboardData['posts']"/>
            <x-blog.dashboard.tabs.tab-activity :groupedActivities="$dashboardData['groupedActivities']" :activities="$dashboardData['activities']"/>
          </x-slot:content>
        </x-ui.tab-container>
      </div>
    </x-section>
  </div>
</x-layout>
