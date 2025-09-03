<div x-data="{ dropdownOpen: false }" class="relative">
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
    class="w-40 rounded-md bg-white shadow-md absolute top-16 right-0"
  >
    <a href="/profile" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">Perfil</a>
    <a href="/admin/dashboard" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">Dashboard</a>
    <form action="/logout" method="POST">
      @csrf
      @method('DELETE')
      <button class="block w-full text-left px-4 py-2 text-sm cursor-pointer text-gray-700 hover:bg-gray-100 transition-colors">Sair</button>
    </form>
  </div>
</div>
