@props([
  'categories'
])

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
      @foreach ($categories as $category)
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