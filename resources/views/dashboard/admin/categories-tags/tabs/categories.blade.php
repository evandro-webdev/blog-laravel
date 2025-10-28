<div x-show="tab === 'categories'">
  <x-ui.base.panel tone="darker">
    <x-section-heading
      title="Categorias"
      desc="Gerencie as categorias do blog"
      class="mb-6"
    />

    <div class="mb-4 rounded-xl border border-gray-200 dark:border-gray-700 overflow-x-auto">
      <table class="w-full text-sm table-auto">
        <thead class="border-b border-gray-200 dark:border-gray-700">
          <tr class="text-left text-gray-600 dark:text-white">
            <th class="p-5">Título</th>
            <th class="p-5 hidden sm:table-cell">Posts</th>
            <th class="p-5 hidden lg:table-cell">Views</th>
            <th class="min-w-[120px] p-5 text-right whitespace-nowrap">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category)
            <tr>
              <td class="p-5">
                {{ Str::ucfirst($category->name) }}
              </td>
              <td class="p-5">
                {{ $category->posts->count() }}
              </td>
              <td class="p-5">
                {{ $category->views->count() }}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </x-ui.base.panel>
</div>