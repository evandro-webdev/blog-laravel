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
          desc="Atualmente a categoria mais visualizada é: {{ $categoriesData['mostViewed']['names'][0] }}"
          class="mb-6"
        />

        <div class="w-full">
          <canvas id="mostViewedCategoriesChart"></canvas>
        </div>
      </x-ui.base.panel>
    </div>
  </div>
</div>

<script>
  const categoriesData = @json($categoriesData);

  function initCategoriesCharts(data) {
    const charts = [
      {
        id: 'mostUsedCategoriesChart',
        names: data.mostUsed.names,
        values: data.mostUsed.count,
        label: 'Posts por categoria',
        gradientStart: '#60A5FA',
        gradientEnd: '#3B82F6',
        border: '#2563EB',
      },
      {
        id: 'mostViewedCategoriesChart',
        names: data.mostViewed.names,
        values: data.mostViewed.viewed,
        label: 'Visualizações por categoria',
        gradientStart: '#C084FC',
        gradientEnd: '#8B5CF6',
        border: '#7C3AED',
      },
    ];

    charts.forEach((chart) => {
      const canvas = document.getElementById(chart.id);
      if (!canvas) return;

      const ctx = canvas.getContext('2d');
      const gradient = ctx.createLinearGradient(0, 0, 0, 400);
      gradient.addColorStop(0, chart.gradientStart);
      gradient.addColorStop(1, chart.gradientEnd);

      createChart(ctx, chart.names, chart.values, chart.label, gradient, chart.border);
    });
  }

  initCategoriesCharts(categoriesData);
</script>
