<aside id="default-sidebar" class="w-64 transition-transform -translate-x-full sm:translate-x-0">
  <div class="h-full px-3 py-10 space-y-6 overflow-y-auto bg-white dark:bg-slate-800">
    <div>
      <h4 class="ml-2 mb-4 text-xl font-semibold text-gray-800 dark:text-white">Pessoal</h4>

      <ul class="space-y-2">
        <x-dashboard.sidebar.link 
          routeName="dashboard.personal.overview"
          icon="chart-bar"
          label="Visão Geral"
        />

        <x-dashboard.sidebar.link 
          routeName="dashboard.personal.posts"
          icon="doc"
          label="Meus posts"
        />

        <x-dashboard.sidebar.link 
          routeName="dashboard.personal.activity"
          icon="doc-list"
          label="Atividade"
        />
      </ul>
    </div>

    @can('access-admin')
      <hr class="text-gray-200 dark:text-slate-700">

      <div>
        <h4 class="ml-2 mb-4 text-xl font-semibold text-gray-800 dark:text-white">Administração</h4>

        <ul class="space-y-2">
          <x-dashboard.sidebar.link 
            routeName="dashboard.admin.overview"
            icon="chart-bar"
            label="Visão Geral"
          />
          <x-dashboard.sidebar.link 
            routeName="dashboard.admin.posts"
            icon="docs"
            label="Posts"
          />
          <x-dashboard.sidebar.link 
            routeName="dashboard.admin.users"
            icon="users"
            label="Usuários"
          />
          <x-dashboard.sidebar.link 
            routeName="dashboard.admin.categories-tags"
            icon="grid"
            label="Categorias e Tags"
          />
        </ul>
      </div>
    @endcan

    
    <a href="#" class="flex items-center p-2 text-gray-600 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
      <x-ui.icons.out size="w-6 h-6" class="text-gray-500"/>
      <span class="flex-1 ms-3 whitespace-nowrap">Sair</span>
    </a>
  </div>
</aside>