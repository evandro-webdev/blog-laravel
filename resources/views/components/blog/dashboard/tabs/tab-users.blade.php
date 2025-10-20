@props([
  'users'
])

<div x-show="tab === 'users'" class="space-y-2">
  <x-ui.base.panel tone="darker">
    <x-section-heading
      title="Usuários"
      desc="Gerencie usuários cadastrados"
      class="mb-6"
    />

    <div class="mb-4 rounded-xl border border-gray-200 dark:border-gray-700 overflow-x-auto">
      <table class="w-full text-sm table-auto">
        <thead class="border-b border-gray-200 dark:border-gray-700">
          <tr class="text-left text-gray-600 dark:text-white">
            <th class="px-3 py-5">Nome</th>
            <th class="px-3 py-5 hidden md:table-cell">Posts</th>
            <th class="px-3 py-5 hidden sm:table-cell">Membro desde</th>
            <th class="px-3 py-5 hidden lg:table-cell">Seguidores</th>
            <th class="px-3 py-5 whitespace-nowrap">Seguindo</th>
            <th class="min-w-[140px] px-3 py-5 text-right whitespace-nowrap">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr class="odd:bg-gray-50 dark:odd:bg-slate-900">
              <td class="max-w-[50ch] px-5 py-5 truncate text-gray-800 dark:text-white">
                <a href="{{ route('profile.show', $user) }}" target="_blank">
                  {{ $user->name }}
                </a>
              </td>
              <td class="px-5 py-5 hidden lg:table-cell text-gray-600 dark:text-gray-100 whitespace-nowrap">
                {{ $user->posts->count() }}
              </td>
              <td class="px-5 py-5 hidden sm:table-cell text-gray-600 dark:text-gray-100 whitespace-nowrap">
                {{ $user->created_at->format('d/m/Y') }}
              </td>
              <td class="px-5 py-5 hidden lg:table-cell text-gray-600 dark:text-gray-100 whitespace-nowrap">
                {{ $user->getFollowersCount() }}
              </td>
              <td class="px-5 py-5 hidden lg:table-cell text-gray-600 dark:text-gray-100 whitespace-nowrap">
                {{ $user->getFollowingCount() }}
              </td>
              <td class="px-5 py-5 text-right whitespace-nowrap">
                <div class="flex items-center justify-end gap-4 text-gray-500 dark:text-white">
                  <form 
                    {{-- action="{{ route('posts.destroy', $post->id) }}"  --}}
                    method="POST" 
                    class="flex"
                  >
                    @csrf
                    @method('DELETE')

                    <x-ui.forms.button 
                      @click.prevent="$dispatch('open-modal', {
                        title: 'Tem certeza?',
                        content: 'Excluir um post é uma ação irreversivel, confirme ou cancele abaixo',
                        onConfirm: () => $el.closest('form').submit()
                      })"
                      type="button"
                      icon="trash"
                      size="sm"
                      variant="danger"
                    >
                      Excluir
                    </x-ui.forms.button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{ $users->appends(['tab' => 'users'])->links() }}

  </x-ui.base.panel>
</div>