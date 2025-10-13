<div class="border-b border-b-gray-200 dark:border-b-slate-800 dark:bg-slate-900 z-50">
  <nav>
    <div 
      x-data="{ isMenuOpen: false }"
      x-init="
        $watch('isMenuOpen', value => {
          document.body.style.overflow = value ? 'hidden' : '';
        })
      "
      class="max-w-[1200px] mx-auto px-2 py-3 md:px-4"
    >
      <div class="flex items-center justify-between">
        <div class="flex items-center justify-between gap-4 lg:gap-8">
          <a href="/" class="shrink-0 font-bold text-xl lg:text-2xl text-blue-500">
            TechInside
          </a>
          <div class="hidden md:flex gap-2">
            <x-nav.desktop-link href="/" :active="request()->is('/')">Início</x-nav.desktop-link>
            <x-nav.desktop-link href="#">Posts</x-nav.desktop-link>
            <x-nav.desktop-link href="#">Categorias</x-nav.desktop-link>
            <x-nav.desktop-link href="#">Mais lidos</x-nav.desktop-link>
          </div>
        </div>

        <div class="flex items-center gap-4">
          <x-ui.interactive.toggle-theme-button/>
          @auth
            <x-nav.notifications.notifications-dropdown/>
            <x-nav.user-dropdown/>
          @endauth
          @guest
            <div class="hidden md:flex items-center gap-4">
              <x-ui.forms.button href="/login" icon="enter" size="sm">Entrar</x-ui.forms.button>
              <x-ui.forms.button href="/register" outline icon="user-plus" size="sm">Criar conta</x-ui.forms.button>
            </div>
          @endguest

          <x-nav.mobile-button/>
        </div>
      </div>

      <x-nav.mobile-menu/>
    </div>
  </nav>
</div>