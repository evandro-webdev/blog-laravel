<div 
  x-data="{ dashboardMenuOpen: false }"
  class="py-4 px-1 sm:px-2 md:px-4 lg:px-10 space-y-4 bg-white dark:bg-slate-800"
>
  <button
    @click="dashboardMenuOpen = !dashboardMenuOpen"
    class="p-1 rounded-lg text-gray-600 dark:text-white hover:bg-gray-100 dark:hover:bg-slate-700 md:hidden"
  >
    <x-ui.icons.menu class="text-white"/>
  </button>
  
  <aside id="default-sidebar" class="h-full transition-transform">
    <div class="h-full space-y-4 md:space-y-6 overflow-y-auto">
      <div>
        <h4 class="hidden md:block ml-2 mb-4 text-xl font-semibold text-gray-800 dark:text-white">Pessoal</h4>
  
        <ul class="space-y-2">
          <x-dashboard.sidebar.link 
            routeName="dashboard.personal.overview"
            icon="chart-bar"
            label="Visão Geral"
            ::show-label="dashboardMenuOpen"
          />
  
          <x-dashboard.sidebar.link 
            routeName="dashboard.personal.posts"
            icon="doc"
            label="Meus posts"
            ::show-label="dashboardMenuOpen"
          />
  
          <x-dashboard.sidebar.link 
            routeName="dashboard.personal.activity"
            icon="doc-list"
            label="Atividade"
            ::show-label="dashboardMenuOpen"
          />
        </ul>
      </div>
  
      @can('access-admin')
        <hr class="text-gray-200 dark:text-slate-700">
  
        <div>
          <h4 class="hidden md:block ml-2 mb-4 text-xl font-semibold text-gray-800 dark:text-white">Administração</h4>
  
          <ul class="space-y-2">
            <x-dashboard.sidebar.link 
              routeName="dashboard.admin.overview"
              icon="chart-bar"
              label="Visão Geral"
              ::show-label="dashboardMenuOpen"
            />
            <x-dashboard.sidebar.link 
              routeName="dashboard.admin.posts"
              icon="docs"
              label="Posts"
              ::show-label="dashboardMenuOpen"
            />
            <x-dashboard.sidebar.link 
              routeName="dashboard.admin.users"
              icon="users"
              label="Usuários"
              ::show-label="dashboardMenuOpen"
            />
            <x-dashboard.sidebar.link 
              routeName="dashboard.admin.categories-tags"
              icon="grid"
              label="Categorias e Tags"
              ::show-label="dashboardMenuOpen"
            />
          </ul>
        </div>
      @endcan
  
      <hr class="text-gray-200 dark:text-slate-700">
      
      <a href="#" class="inline-flex items-center p-1 rounded-lg text-gray-600 dark:text-white hover:bg-gray-100 dark:hover:bg-slate-700 group">
        <x-ui.icons.out size="w-5 h-5 md:w-6 md:h-6"/>
        <span class="flex-1 ms-3 hidden md:block">Sair</span>
      </a>
    </div>
  </aside>
</div>