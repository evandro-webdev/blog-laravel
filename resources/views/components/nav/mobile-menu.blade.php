<div
  x-show="isMenuOpen"
  x-cloak
  x-transition.opacity.duration.200ms
  class="fixed inset-0 top-[64px] z-50 bg-black/40 md:hidden"
>
  <div
    x-show="isMenuOpen"
    @click.outside="isMenuOpen=false"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-y-6 opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="-translate-y-6 opacity-0"
    class="h-fit rounded-b-xl overflow-hidden bg-white dark:bg-slate-800"
  >
    <div class="px-2 py-6 space-y-1">
      <x-nav.mobile-link href="/" :active="request()->is('/')">Início</x-nav.mobile-link>
      <x-nav.mobile-link href="#">Posts</x-nav.mobile-link>
      <x-nav.mobile-link href="#">Categorias</x-nav.mobile-link>
      <x-nav.mobile-link href="#">Mais lidos</x-nav.mobile-link>
    </div>  

    <div
      x-data="{ isOpen: false }"
      class="py-2 px-2 border-t border-gray-300 dark:border-slate-700 bg-gray-50 dark:bg-slate-800"
    >
      @auth
        <div 
          @click="isOpen=!isOpen"
          class="py-4 px-2 flex justify-between items-center gap-2 cursor-pointer"
        >
          <div class="flex items-center gap-2">
            <x-profile.avatar :user="Auth::user()"/>
            
            <div>
              <div class="text-base font-medium text-gray-800 dark:text-white">{{ Auth::user()->name }}</div>
              <div class="text-sm text-gray-500 dark:text-gray-300">{{ Auth::user()->email }}</div>
            </div>
          </div>

          <x-ui.icons.chevron 
            class="text-gray-700 dark:text-gray-300 transform transition-transform duration-400"
            x-bind:class="isOpen ? 'rotate-x-180' : 'rotate-0'"
          />
        </div>

        <div
          x-show="isOpen"
          x-collapse.duration.300ms
          class="space-y-1"
        >
          <x-nav.mobile-link href="{{ route('profile.show', Auth::user()) }}" :active="request()->routeIs('profile.show')">Perfil</x-nav.mobile-link>
          <x-nav.mobile-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">Dashboard</x-nav.mobile-link>

          <form action="/logout" method="POST">
            @csrf
            @method('DELETE')
            <button class="w-full px-3 py-2 cursor-pointer text-left rounded-md text-gray-600 dark:text-white hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors">
              Sair
            </button>
          </form>
        </div>
      @endauth
      @guest
        <x-ui.utilities.auth-prompt message="Entre para publicar posts e muito mais"/>
      @endguest
    </div>
  </div>
</div>