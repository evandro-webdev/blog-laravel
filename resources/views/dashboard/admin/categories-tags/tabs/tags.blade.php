<div x-show="tab === 'tags'">
  <div class="flex gap-2">
    <x-ui.base.panel tone="darker">
      <div class="mb-6 flex items-center justify-between">
        <x-section-heading
          title="Tags"
          desc="Gerencie as tags do blog, atualmente há {{ $tagsData['tags']->count() }} tags existentes"
        />
  
        <form action="{{ route('admin.tags.store') }}" method="POST" class="flex gap-2">
          @csrf
          <x-ui.forms.input size="sm" name="name" placeholder="Nome da tag"/>
          <x-ui.forms.button size="sm">Adicionar</x-ui.forms.button>
        </form>
      </div>

      @include(
        'dashboard.admin.categories-tags.components.tags-table',
        ['tags' => $tagsData['tags']]
      )
    </x-ui.base.panel>

    <div class="space-y-2 max-w-lg">
      <x-ui.base.panel tone="darker">
        <x-section-heading
          title="Tags mais usadas"
          desc="Atualmente a tag mais utilizada pelos autores é: {{ $tagsData['mostUsed']['names'][0] }}"
          class="mb-6"
        />
  
        <div class="w-full">
          <canvas id="mostUsedTagsChart"></canvas>
        </div>
      </x-ui.base.panel>

      <x-ui.base.panel tone="darker">
        <x-section-heading
          title="Tags mais visualizadas"
          desc="Atualmente a tag mais visualizada é: {{ $tagsData['mostViewed']['names'][0] }}"
          class="mb-6"
        />

        <div class="w-full">
          <canvas id="mostViewedTagsChart"></canvas>
        </div>
      </x-ui.base.panel>
    </div>
  </div>
</div>

<script>
  const tagsData = @json($tagsData);
  console.log(tagsData)

  function initTagCharts(data) {
    const charts = [
      {
        id: 'mostUsedTagsChart',
        names: data.mostUsed.names,
        values: data.mostUsed.count,
        label: 'Posts por tag',
        gradientStart: '#60A5FA',
        gradientEnd: '#3B82F6',
        border: '#2563EB',
      },
      {
        id: 'mostViewedTagsChart',
        names: data.mostViewed.names,
        values: data.mostViewed.viewed,
        label: 'Visualizações por tag',
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

  initTagCharts(tagsData);
</script>