<div class="mb-4 rounded border border-gray-200 dark:border-gray-700 overflow-x-auto">
  <table class="w-full text-sm table-auto">
    <thead class="border-b border-gray-200 dark:border-gray-700">
      <tr class="text-left text-gray-600 dark:text-white">
        <th class="px-3 py-5">Título</th>
        <th class="px-3 py-5 hidden md:table-cell">Categoria</th>
        <th class="px-3 py-5 hidden sm:table-cell">Data</th>
        <th class="px-3 py-5 hidden lg:table-cell">Views</th>
        <th class="px-3 py-5 whitespace-nowrap">Status</th>
        <th class="min-w-[140px] px-3 py-5 text-right whitespace-nowrap">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $post)
        <x-blog.dashboard.tabs.posts.row :$post/>
      @endforeach
    </tbody>
  </table>
</div>

{{ $posts->appends(['tab' => 'posts'])->links() }}