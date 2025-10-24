<aside id="default-sidebar" class="w-64 h-screen transition-transform -translate-x-full sm:translate-x-0">
  <div class="h-full px-3 py-10 space-y-6 overflow-y-auto bg-white dark:bg-gray-800">
    <div>
      <h4 class="ml-2 mb-4 text-xl font-normal text-gray-800">Pessoal</h4>

      <ul class="space-y-2">
        <li>
          <a 
            href="{{ route('dashboard.personal.overview') }}" 
            class="{{ request()->is('dashboard') ? 'text-gray-700 dark:text-white bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-700' : 'text-gray-600 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }} flex items-center p-2 rounded-lg group"
          >
            <x-ui.icons.chart-bar size="w-6 h-6" class="text-gray-500"/>
            <span class="ms-3">Visão Geral</span>
          </a>
        </li>

        <li>
          <a 
            href="{{ route('dashboard.personal.posts') }}"
            class="{{ request()->is('dashboard/posts') ? 'text-gray-700 dark:text-white bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-700' : 'text-gray-600 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }} flex items-center p-2 rounded-lg group"
          >
            <x-ui.icons.doc size="w-6 h-6" class="text-gray-500"/>
            <span class="flex-1 ms-3 whitespace-nowrap">Posts</span>
          </a>
        </li>

        <li>
          <a 
            href="{{ route('dashboard.personal.activity') }}" 
            class="{{ request()->is('dashboard/activity') ? 'text-gray-700 dark:text-white bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-700' : 'text-gray-600 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }} flex items-center p-2 rounded-lg group"
          >
            <x-ui.icons.doc-list size="w-6 h-6" class="text-gray-500"/>
            <span class="flex-1 ms-3 whitespace-nowrap">Atividade</span>
          </a>
        </li>
      </ul>
    </div>

    <hr class="text-gray-200">

    <div>
      <h4 class="ml-2 mb-4 text-xl font-normal text-gray-800">Administração</h4>

      <ul class="space-y-2">
        <li>
          <a 
            href="#" 
            class="flex items-center p-2 text-gray-600 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
          >
            <x-ui.icons.chart-bar size="w-6 h-6" class="text-gray-500"/>
            <span class="ms-3">Visão Geral</span>
          </a>
        </li>
        <li>
          <a 
            href="#" 
            class="flex items-center p-2 text-gray-600 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
          >
            <x-ui.icons.users size="w-6 h-6" class="text-gray-500"/>
            <span class="flex-1 ms-3 whitespace-nowrap">Usuários</span>
          </a>
        </li>
        <li>
          <a 
            href="#" 
            class="flex items-center p-2 text-gray-600 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
          >
            <x-ui.icons.doc size="w-6 h-6" class="text-gray-500"/>
            <span class="flex-1 ms-3 whitespace-nowrap">Posts</span>
          </a>
        </li>
        <li>
          <a 
            href="#" 
            class="flex items-center p-2 text-gray-600 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
          >
            <x-ui.icons.grid size="w-6 h-6" class="text-gray-500"/>
            <span class="flex-1 ms-3 whitespace-nowrap">Categorias e Tags</span>
          </a>
        </li>
      </ul>
    </div>
    
    <a href="#" class="flex items-center p-2 text-gray-600 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
      <x-ui.icons.out size="w-6 h-6" class="text-gray-500"/>
      <span class="flex-1 ms-3 whitespace-nowrap">Sair</span>
    </a>
  </div>
</aside>