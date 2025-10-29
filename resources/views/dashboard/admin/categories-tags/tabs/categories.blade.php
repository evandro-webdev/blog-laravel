<div x-show="tab === 'categories'">
  <x-ui.base.panel tone="darker">
    <div class="max-w-4xl">
      <div class="mb-6 flex items-center justify-between">
        <x-section-heading
          title="Categorias"
          desc="Gerencie as categorias do blog, atualmente há {{ $categories->count() }} categorias existentes"
        />
  
        <form action="{{ route('admin.categories.store') }}" method="POST" class="flex gap-2">
          @csrf
          <x-ui.forms.input size="sm" name="name" placeholder="Nome da categoria"/>
          <x-ui.forms.button size="sm">Adicionar</x-ui.forms.button>
        </form>
      </div>
  
      <div class="mb-4 rounded-xl border border-gray-200 dark:border-gray-700 overflow-x-auto">
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
            @foreach ($categories as $category)
              <tr x-data="{ isEditing: false }">
                <td class="max-w-xs p-4">
                  <span x-show="!isEditing">{{ Str::ucfirst($category->name) }}</span>

                  <form id="form-{{ $category->id }}" action="{{ route('admin.categories.update', $category) }}" method="POST">
                    @method('PATCH')
                    @csrf

                    <x-ui.forms.input 
                      x-show="isEditing" 
                      size="sm" 
                      name="name" 
                      value="{{ $category->name }}" 
                      placeholder="Nome da categoria"
                      class="max-w-sm"
                    />
                  </form>
                </td>
                <td class="p-4">
                  {{ $category->posts->count() }}
                </td>
                <td class="p-4">
                  {{ $category->views->count() }}
                </td>
                <td class="p-4">
                  <div x-show="!isEditing" class="flex justify-end gap-2">
                    <x-ui.forms.button @click="isEditing=!isEditing" size="sm">Editar</x-ui.forms.button>
                    <x-ui.forms.button size="sm" variant="danger">Excluir</x-ui.forms.button>
                  </div>
                  <div x-show="isEditing" class="flex justify-end gap-2">
                    <x-ui.forms.button @click="isEditing=!isEditing" size="sm" variant="neutral">Cancelar</x-ui.forms.button>
                    <x-ui.forms.button form="form-{{ $category->id }}" size="sm">Salvar</x-ui.forms.button>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
      {{ $categories->links() }}
    </div>
    
  </x-ui.base.panel>

  <x-ui.toast/>
</div>