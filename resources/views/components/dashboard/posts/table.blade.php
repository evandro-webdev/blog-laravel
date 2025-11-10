@props([
  'posts'
])

<div class="mb-4 rounded-xl border border-gray-200 dark:border-gray-700 overflow-x-auto">
  <table class="w-full text-sm table-auto">
    <thead class="border-b border-gray-200 dark:border-gray-700">
      <tr class="text-left text-gray-600 dark:text-white">
        <th class="p-5">Título</th>
        <th class="p-5 hidden md:table-cell">Categoria</th>
        <th class="p-5 hidden sm:table-cell">Data</th>
        <th class="p-5 hidden lg:table-cell">Views</th>
        <th class="p-5 whitespace-nowrap">Status</th>
        <th class="min-w-[120px] p-5 text-right whitespace-nowrap">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $post)
        <x-dashboard.posts.row :$post/>
      @endforeach
    </tbody>
  </table>
</div>

{{ $posts->appends(['tab' => 'all'])->links() }}