@props([
  'user'
])

<tr class="odd:bg-gray-50 dark:odd:bg-slate-900">
  <td class="p-5 text-gray-800 dark:text-white">
    <a href="{{ route('profile.show', $user) }}" target="_blank">
      {{ $user->name }}
    </a>
  </td>
  <td class="p-5 hidden md:table-cell text-gray-600 dark:text-gray-100 whitespace-nowrap">
    {{ $user->posts->count() }}
  </td>
  <td class="p-5 hidden sm:table-cell text-gray-600 dark:text-gray-100 whitespace-nowrap">
    {{ $user->created_at->format('d/m/Y') }}
  </td>
  <td class="p-5 hidden lg:table-cell text-gray-600 dark:text-gray-100 whitespace-nowrap">
    {{ $user->getFollowersCount() }}
  </td>
  <td class="p-5 hidden lg:table-cell text-gray-600 dark:text-gray-100 whitespace-nowrap">
    {{ $user->getFollowingCount() }}
  </td>
  <td class="p-5 table-cell text-gray-600 dark:text-gray-100 whitespace-nowrap">
    <form action="{{ route('admin.users.updateRole', $user) }}" method="POST">
      @csrf
      @method('PATCH')

      <select name="role" onchange="this.form.submit()">
        <option value="author" {{ $user->role === 'author' ? 'selected' : '' }}>Autor</option>
        <option value="moderator" {{ $user->role === 'moderator' ? 'selected' : '' }}>Moderador</option>
        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrador</option>
      </select>
    </form>
  </td>
  <td class="p-5 text-right whitespace-nowrap">
    <div class="flex items-center justify-end gap-4 text-gray-500 dark:text-white">
      <form 
        action="{{ route('admin.users.destroy', $user) }}" 
        method="POST" 
        class="flex"
      >
        @csrf
        @method('DELETE')

        <x-ui.forms.button 
          @click.prevent="$dispatch('open-modal', {
            title: 'Excluir usuário?',
            content: 'Tem certeza que deseja excluir esse usuário?',
            onConfirm: () => $el.closest('form').submit()
          })"
          type="button"
          icon="trash"
          size="xs"
          variant="danger"
        >
          Excluir
        </x-ui.forms.button>
      </form>
    </div>
  </td>
</tr>