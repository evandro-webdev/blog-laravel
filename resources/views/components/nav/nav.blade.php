<div class="min-h-full border-b border-b-gray-200 dark:border-b-gray-700 dark:bg-gray-900">
  <nav>
    <div class="max-w-[1200px] mx-auto px-2 md:px-4">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <a href="/" class="shrink-0 font-bold text-xl text-blue-600">
            TechInside
          </a>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <x-nav.desktop-link href="/" :active="request()->is('/')">Início</x-nav.desktop-link>
              <x-nav.desktop-link href="/posts" :active="request()->is('posts')">Posts</x-nav.desktop-link>
              <x-nav.desktop-link>Categorias</x-nav.desktop-link>
              <x-nav.desktop-link :active="request()->is('popular')">Mais lidos</x-nav.desktop-link>
            </div>
          </div>
        </div>

        @auth
          <div class="hidden md:flex items-center gap-2">
            <x-ui.toggle-theme-button/>
            <x-nav.notifications.notifications-dropdown/>
            <x-nav.user-dropdown/>
          </div>
        @endauth

        @guest
          <div class="items-center gap-2 hidden md:flex">
            <x-ui.forms.button href="/login" icon="enter" size="sm">Entrar</x-ui.forms.button>
            <x-ui.forms.button href="/register" outline icon="user-plus" size="sm">Criar conta</x-ui.forms.button>
          </div>
        @endguest

        <x-nav.mobile-button/>
      </div>
    </div>

    <x-nav.mobile-menu/>
  </nav>
</div>