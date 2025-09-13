<tr class="odd:bg-gray-50 dark:odd:bg-gray-800">
  <td class="px-3 py-5 truncate text-gray-800 dark:text-white">
    {{ $post->title }}
  </td>
  <th class="px-3 py-3 hidden font-medium text-left text-gray-600 dark:text-gray-100 md:table-cell">{{ $post->category->name }}</th>
  <td class="px-3 py-5 hidden sm:table-cell text-gray-600 dark:text-gray-100 whitespace-nowrap">
    {{ $post->created_at->format('d/m/Y') }}
  </td>
  <td class="px-3 py-5 hidden lg:table-cell text-gray-600 dark:text-gray-100 whitespace-nowrap">
    {{ $post->views }}
  </td>
  <td class="px-3 py-5 whitespace-nowrap">
    @if ($post->featured)
      <x-ui.badge variant="blue" small>Destaque</x-ui.badge>
    @elseif ($post->published)
      <x-ui.badge small>Publicado</x-ui.badge>
    @else
      <x-ui.badge variant="white" small>Oculto</x-ui.badge>
    @endif
  </td>

  <td class="px-3 py-5 text-right whitespace-nowrap">
    <div class="flex justify-end gap-4 text-gray-500 dark:text-white">
      <a href="/posts/{{ $post->slug }}" target="_blank">
        <x-ui.icons.eye/>
      </a>
      <a href="/admin/posts/{{ $post->id }}/edit">
        <x-ui.icons.edit/>
      </a>
      <form action="/admin/posts/{{ $post->id }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="cursor-pointer">
          <x-ui.icons.trash/>
        </button>
      </form>
    </div>
  </td>
</tr>