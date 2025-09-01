<div class="min-h-full border-b border-b-gray-200">
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
          <div class="flex items-center">
            <div x-data="{ notificationsOpen: false }" class="relative">
              <button 
                @click="notificationsOpen = !notificationsOpen; if(notificationsOpen) markAsRead()" 
                @click.away="notificationsOpen = false"
                x-cloak
                class="p-2 rounded-full cursor-pointer hover:bg-blue-50 transition-colors relative"
              >
                <span class="w-4 h-4 rounded-full text-xs font-bold text-white bg-blue-600 absolute top-1">{{ Auth::user()->notifications->whereNull('read_at')->count() }}</span>
                <x-icon.bell class="w-6 h-6 text-blue-600" stroke="1.5"/>
              </button>

              <div 
                x-show="notificationsOpen" 
                x-transition
                class="w-80 rounded-md absolute top-16 right-0 bg-white shadow-md ring-1 ring-black/5 origin-top-right"
              >
                <div class="py-2 px-3 border-b border-gray-100 text-sm font-medium text-gray-800 flex justify-between items-center">
                  <p>Notificações</p>
                  @if(Auth::user()->notifications->whereNull('read_at')->count() > 0)
                    <x-ui.badge pill small>
                      {{ Auth::user()->notifications->whereNull('read_at')->count() }} novas
                    </x-ui.badge>
                  @endif
                </div>

                <div class="max-h-80 overflow-y-auto">
                  @forelse (Auth::user()->notifications as $notification)
                    <div class="p-3 flex gap-2 hover:bg-blue-50 transition-colors">
                      <x-profile.avatar :user="$notification->actor" />
                      <div class="flex flex-col gap-1">
                        <a href="#" class="text-sm font-medium text-gray-800">
                          {{ $notification->data['message'] }}
                        </a>
                        <time class="text-xs text-gray-600" datetime="{{ $notification->created_at }}">
                          {{ $notification->created_at->diffForHumans() }}
                        </time>
                      </div>
                    </div>
                  @empty
                    <div class="p-4 text-sm text-gray-500 text-center">
                      Nenhuma notificação
                    </div>
                  @endforelse
                </div>
              </div>
            </div>
            <x-nav.user-dropdown/>
          </div>
        @endauth

        @guest
          <div class="items-center gap-2 hidden md:flex">
            <x-ui.forms.button href="/login">Entrar</x-ui.forms.button>
            <x-ui.forms.button href="/register" outline>Criar conta</x-ui.forms.button>
          </div>
        @endguest

        <x-nav.mobile-button/>
      </div>
    </div>

    <x-nav.mobile-menu/>
  </nav>
</div>

<script>
  function markAsRead() {
    fetch('/notifications/read', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
  }
</script>