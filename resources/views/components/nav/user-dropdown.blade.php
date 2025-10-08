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
    class="absolute top-16 right-0 w-40 rounded-md border-1 border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-md overflow-hidden"
  >
    <a href="{{ route('profile.show', Auth::user()) }}" class="w-full px-4 py-3 text-sm text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-slate-700 flex items-center gap-2 transition-colors">
      <x-ui.icons.user/>
      <span>Perfil</span>
    </a>
    <a href="{{ route('admin.dashboard') }}" class="w-full px-4 py-3 text-sm text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-slate-700 flex items-center gap-2 transition-colors">
      <x-ui.icons.chart-bar/>
      <span>Dashboard</span>
    </a>
    <form action="/logout" method="POST">
      @csrf
      @method('DELETE')
      <button class="w-full text-left px-4 py-3 text-sm cursor-pointer text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-slate-700 flex items-center gap-2 transition-colors">
        <x-ui.icons.out/>
        <span>Sair</span>
      </button>
    </form>
  </div>
</div>
