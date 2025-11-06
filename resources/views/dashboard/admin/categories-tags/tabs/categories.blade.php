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
  
      @include(
        'dashboard.admin.categories-tags.components.categories-table',
        ['categories' => $categoriesData['categories']]
      )
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
