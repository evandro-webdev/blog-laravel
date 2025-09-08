<x-layout>
  <div class="bg-gray-50 flex-1">
    <x-section>
      <div class="max-w-[1280px] mx-auto">
        <div class="sm:flex items-center justify-between">
          <x-page-heading title="Dashboard" subtitle="Gerencie o conteúdo do seu blog e veja estatísticas." class="!mb-4"/>
          <x-ui.forms.button href="/admin/posts/create">Novo post</x-ui.forms.button>
        </div>
        
        <x-ui.tab-container default-tab="overview" class="space-y-2">
          <x-slot:tabs>
            <x-ui.tab value="overview" x-model="tab">Visão</x-ui.tab>
            <x-ui.tab value="posts" x-model="tab">Posts</x-ui.tab>
            <x-ui.tab value="drafts" x-model="tab">Rascunhos</x-ui.tab>
          </x-slot:tabs>

          <x-slot:content>
            <x-blog.dashboard.tabs.tab-overview :$statistics :$groupedActivities :$activities :$popularCategories/>
            <x-blog.dashboard.tabs.tab-posts :$posts/>
            <x-blog.dashboard.tabs.tab-drafts/>
          </x-slot:content>
        </x-ui.tab-container>
      </div>
    </x-section>
  </div>
</x-layout>
