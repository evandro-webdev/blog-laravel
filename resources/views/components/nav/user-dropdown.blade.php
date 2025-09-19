<div x-data="{ dropdownOpen: false }" class="relative flex items-center justify-center">
  <button
    @click="dropdownOpen = !dropdownOpen"
    @click.away="dropdownOpen = false"
    x-cloak
    type="button"
    class="relative rounded-full cursor-pointer"
  >
    <x-profile.avatar :user="Auth::user()"/>
  </button>

  <div
    x-show="dropdownOpen"
    x-transition
    class="w-40 rounded-md bg-white dark:bg-gray-800 shadow-md absolute top-16 right-0 overflow-hidden"
  >
    <a href="{{ route('profile.show', Auth::user()) }}" class="w-full px-4 py-3 text-sm text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-900 flex items-center gap-2 transition-colors">
      <x-ui.icons.user/>
      <span>Perfil</span>
    </a>
    <a href="{{ route('admin.dashboard') }}" class="w-full px-4 py-3 text-sm text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-900 flex items-center gap-2 transition-colors">
      <x-ui.icons.chart-bar/>
      <span>Dashboard</span>
    </a>
    <form action="/logout" method="POST">
      @csrf
      @method('DELETE')
      <button class="w-full text-left px-4 py-3 text-sm cursor-pointer text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-900 flex items-center gap-2 transition-colors">
        <x-ui.icons.out/>
        <span>Sair</span>
      </button>
    </form>
  </div>
</div>
