@props([
  'users'
])

<div class="mb-4 rounded-xl border border-gray-200 dark:border-gray-700 overflow-x-auto">
  <table class="w-full text-sm table-auto">
    <thead class="border-b border-gray-200 dark:border-gray-700">
      <tr class="text-left text-gray-600 dark:text-white">
        <th class="p-5">Nome</th>
        <th class="p-5 hidden md:table-cell">Posts</th>
        <th class="p-5 hidden sm:table-cell">Membro desde</th>
        <th class="p-5 hidden lg:table-cell">Seguidores</th>
        <th class="p-5 hidden lg:table-cell">Seguindo</th>
        <th class="p-5 whitespace-nowrap">Cargo</th>
        <th class="min-w-[140px] p-5 text-right whitespace-nowrap">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        <x-dashboard.users.row :$user/>
      @endforeach
    </tbody>
  </table>
</div>

{{ $users->appends(['tab' => 'users'])->links() }}