<tr class="odd:bg-gray-50 dark:odd:bg-slate-600">
  <td class="max-w-[50ch] px-3 py-5 truncate text-gray-800 dark:text-white" title="{{ $post->title }}">
    <a href="/posts/{{ $post->slug }}" target="_blank">
      {{ $post->title }}
    </a>
  </td>
  <th class="px-3 py-3 hidden font-medium text-left text-gray-600 dark:text-gray-100 md:table-cell">{{ $post->category->name }}</th>
  <td class="px-3 py-5 hidden sm:table-cell text-gray-600 dark:text-gray-100 whitespace-nowrap">
    {{ $post->created_at->format('d/m/Y') }}
  </td>
  <td class="px-3 py-5 hidden lg:table-cell text-gray-600 dark:text-gray-100 whitespace-nowrap">
    {{ $post->views->count() }}
  </td>
  <td class="px-3 py-5 whitespace-nowrap">
    @if ($post->featured)
      <x-ui.base.badge variant="blue" small>Destaque</x-ui.base.badge>
    @elseif ($post->published)
      <x-ui.base.badge small>Publicado</x-ui.base.badge>
    @else
      <x-ui.base.badge variant="white" small>Oculto</x-ui.base.badge>
    @endif
  </td>

  <td class="px-3 py-5 text-right whitespace-nowrap">
    <div class="flex items-center justify-end gap-4 text-gray-500 dark:text-white">
      <a href="/admin/posts/{{ $post->id }}/edit">
        <x-ui.icons.edit class="text-blue-600 dark:text-blue-500"/>
      </a>

      <form 
        action="{{ route('posts.destroy', $post->id) }}" 
        method="POST" 
        class="flex"
      >
        @csrf
        @method('DELETE')

        <button 
          type="button"
          @click.prevent="$dispatch('open-modal', {
            title: 'Tem certeza?',
            content: 'Excluir um post é uma ação irreversivel, confirme ou cancele abaixo',
            onConfirm: () => $el.closest('form').submit()
          })" 
          class="cursor-pointer"
        >
          <x-ui.icons.trash class="text-red-600 dark:text-red-500"/>
        </button>
      </form>
    </div>
  </td>
</tr>