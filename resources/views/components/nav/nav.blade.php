<div class="min-h-full border-b border-b-gray-200 dark:border-b-slate-800 dark:bg-slate-900 z-50">
  <nav>
    <div class="max-w-[1200px] mx-auto px-2 md:px-4">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <a href="/" class="shrink-0 font-bold text-xl text-blue-500">
            TechInside
          </a>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <x-nav.desktop-link href="/" :active="request()->is('/')">Início</x-nav.desktop-link>
              <x-nav.desktop-link href="/posts" :active="request()->is('posts')">Posts</x-nav.desktop-link>
              <x-nav.desktop-link href="#">Categorias</x-nav.desktop-link>
              <x-nav.desktop-link href="#" :active="request()->is('popular')">Mais lidos</x-nav.desktop-link>
            </div>
          </div>
        </div>

        <div class="hidden md:flex items-center gap-4">
          <x-ui.interactive.toggle-theme-button/>
          @auth
            <x-nav.notifications.notifications-dropdown/>
            <x-nav.user-dropdown/>
          @endauth
          @guest
            <x-ui.forms.button href="/login" icon="enter" size="sm">Entrar</x-ui.forms.button>
            <x-ui.forms.button href="/register" outline icon="user-plus" size="sm">Criar conta</x-ui.forms.button>
          @endguest
        </div>

        <x-nav.mobile-button/>
      </div>
    </div>

    <x-nav.mobile-menu/>
  </nav>
</div>