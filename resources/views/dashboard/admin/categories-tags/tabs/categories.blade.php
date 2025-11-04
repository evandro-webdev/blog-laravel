<div x-show="tab === 'categories'">
  <div class="flex gap-2">
    <x-ui.base.panel tone="darker">
      <div class="mb-6 flex items-center justify-between">
        <x-section-heading
          title="Categorias"
          desc="Gerencie as categorias do blog, atualmente há {{ $categoriesData['categories']->count() }} categorias existentes"
        />
  
        <form action="{{ route('admin.categories.store') }}" method="POST" class="flex gap-2">
          @csrf
          <x-ui.forms.input size="sm" name="name" placeholder="Nome da categoria"/>
          <x-ui.forms.button size="sm">Adicionar</x-ui.forms.button>
        </form>
      </div>
  
      <div class="mb-4 rounded-xl border border-gray-200 dark:border-slate-700 overflow-x-auto">
        <table class="table-fixed w-full text-sm">
          <thead class="border-b border-gray-200 dark:border-gray-700">
            <tr class="text-left text-gray-600 dark:text-white">
              <th class="max-w-xs p-4">Título</th>
              <th class="p-4 hidden sm:table-cell">Posts</th>
              <th class="p-4 hidden lg:table-cell">Views</th>
              <th class="p-4 text-right whitespace-nowrap">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categoriesData['categories'] as $category)
              <tr 
                x-data="{ isEditing: false }" 
                class="min-h-[70px] text-gray-600 dark:text-gray-100 odd:bg-gray-50 dark:odd:bg-slate-900 group"
              >
                <td class="min-h-[70px] max-w-xs p-4">
                  <span x-show="!isEditing">{{ Str::ucfirst($category->name) }}</span>

                  <form x-show="isEditing" id="category-form-{{ $category->id }}" action="{{ route('admin.categories.update', $category) }}" method="POST">
                    @method('PATCH')
                    @csrf

                    <input 
                      x-show="isEditing" 
                      name="name" 
                      value="{{ $category->name }}" 
                      placeholder="Nome da categoria"
                      class="px-2 py-1 -ml-2 -my-1 rounded-lg text-sm border border-gray-200 dark:border-slate-600 placeholder-gray-400 bg-white dark:bg-slate-700"
                    />
                  </form>
                </td>
                <td class="p-4">
                  <x-ui.base.badge small>
                    {{ $category->posts->count() }} posts
                  </x-ui.base.badge>
                </td>
                <td class="p-4">
                  {{ $category->views->count() }}
                </td>
                <td class="p-4">
                  <div x-show="!isEditing" class="flex justify-end gap-2">
                    <x-ui.forms.button @click="isEditing=!isEditing" size="xs" outline>Editar</x-ui.forms.button>
                    <form action="{{ route('admin.categories.delete', $category) }}" method="POST">
                      @method('DELETE')
                      @csrf
                      <x-ui.forms.button size="xs" variant="danger" outline>Excluir</x-ui.forms.button>
                    </form>
                  </div>
                  <div x-show="isEditing" class="flex justify-end gap-2">
                    <x-ui.forms.button @click="isEditing=!isEditing" size="xs" variant="neutral" outline>Cancelar</x-ui.forms.button>
                    <x-ui.forms.button form="category-form-{{ $category->id }}" size="xs">Salvar</x-ui.forms.button>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
      {{ $categoriesData['categories']->links() }}
    </x-ui.base.panel>

    <div class="space-y-2 max-w-lg">
      <x-ui.base.panel tone="darker">
        <x-section-heading
          title="Categorias mais usadas"
          desc="Atualmente a categoria mais utilizada pelos autores é: {{ $categoriesData['mostUsed']['names'][0] }}"
          class="mb-6"
        />
  
        <div class="w-full">
          <canvas id="mostUsedCategoriesChart"></canvas>
        </div>
      </x-ui.base.panel>

      <x-ui.base.panel tone="darker">
        <x-section-heading
          title="Categorias mais visualizadas"
          desc="Gerencie as categorias do blog, atualmente há {{ $categoriesData['categories']->count() }} categorias existentes"
          class="mb-6"
        />

        <div class="w-full">
          <canvas id="mostViewedCategoriesChart"></canvas>
        </div>
      </x-ui.base.panel>
    </div>
  </div>
</div>

<script src="{{ Vite::asset('resources/js/charts/chart.js') }}"></script>
<script>
  const mostUsed = document.querySelector('#mostUsedCategoriesChart');
  const mostViewed = document.querySelector('#mostViewedCategoriesChart');

  const categoriesData = @json($categoriesData);

  isDarkMode = localStorage.theme === 'dark';

  const palette = {
    text: isDarkMode ? '#D1D5DB' : '#374151',
    grid: isDarkMode ? '#374151' : '#E5E7EB',
    tooltipBg: isDarkMode ? '#1F2937' : '#F9FAFB',
    tooltipText: isDarkMode ? '#E5E7EB' : '#1F2937'
  }

  const ctx1 = mostUsed.getContext('2d');
  const ctx2 = mostViewed.getContext('2d');

  const gradientBlue = ctx1.createLinearGradient(0, 0, 0, 400);
  gradientBlue.addColorStop(0, '#60A5FA');
  gradientBlue.addColorStop(1, '#3B82F6');

  const gradientPurple = ctx2.createLinearGradient(0, 0, 0, 400);
  gradientPurple.addColorStop(0, '#C084FC');
  gradientPurple.addColorStop(1, '#8B5CF6');

  createChart(
    ctx1,
    categoriesData.mostUsed.names,
    categoriesData.mostUsed.count,
    'Posts por categoria',
    gradientBlue,
    '#2563EB'
  );

  createChart(
    ctx2,
    categoriesData.mostViewed.names,
    categoriesData.mostViewed.viewed,
    'Visualizações por categoria',
    gradientPurple,
    '#7C3AED'
  );
</script>
