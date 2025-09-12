<x-layout>
  <div class="bg-gray-50">
    <x-section>
      <x-page-heading 
        title="{{ $user ? 'Bem vindo de volta, ' . $user->name : 'Bem vindo' }} " 
        subtitle="Veja o que acontece na área de tecnologia"
        class="mb-4"
      />

      <div class="flex flex-col gap-6 lg:flex-row">
        <div class="flex-1">
          <div class="mb-4 flex border-b border-gray-200">
            <a 
              href="{{ request()->url() }}?tab=personal-feed&sort=recent" 
              class="px-4 py-2 -mb-px border-b-2 font-medium text-sm
                {{ $tab === 'personal-feed' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
            >
              Seguindo
            </a>

            <a 
              href="{{ request()->url() }}?tab=trending-feed&sort=popular" 
              class="px-4 py-2 -mb-px border-b-2 font-medium text-sm
                {{ $tab === 'trending-feed' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
            >
              Em alta
            </a>
          </div>

          <div>
            @if ($tab === 'personal-feed')
              @auth
                <x-home.tabs.tab-personal-feed :$sort :$posts/>
              @else
                <x-ui.panel class="flex flex-col items-center gap-4">
                  <p class="text-gray-600">Faça login para ver os posts de quem você segue.</p>
                  <x-ui.forms.button href="/login" small>Entrar</x-ui.forms.button>
                  <p class="text-sm text-gray-500">
                    Ainda não tem conta?
                    <a href="/register" class="text-blue-600 hover:underline">Cadastre-se</a>
                  </p>
                </x-ui.panel>
              @endauth
            @endif

            @if ($tab === 'trending-feed')
              <x-home.tabs.tab-trending-feed :$sort :$posts/>
            @endif
          </div>
        </div>

        <div class="flex flex-col gap-6 lg:min-w-xs sm:flex-row lg:flex-col">
          @auth
            <x-ui.panel class="flex-1 sm:flex-0">
              <div class="mb-6 flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-800">Seguindo</h2>
                <a href="#" class="text-sm text-blue-600 hover:underline">Ver todos</a>
              </div>
    
              <div class="space-y-2">
                @foreach ($user->following as $following)
                  <a href="{{ route('profile.show', $following) }}" class="p-2 rounded-md cursor-pointer flex items-center gap-2 hover:bg-gray-100 transition-colors">
                    <x-profile.avatar :user="$following" size="w-10 h-10"/>
                    <div class="flex flex-col">
                      <span class="text-sm font-medium text-gray-800">{{ $following->name }}</span>
                      <span class="text-xs text-gray-500">{{ $following->posts->count() }} posts</span>
                    </div>
                  </a>
                @endforeach
              </div>
            </x-ui.panel>
          @endauth
  
          <x-ui.panel class="flex-1 sm:flex-0">
            <div class="mb-6 flex items-center justify-between">
              <h2 class="text-lg font-bold text-gray-800">Sugerido para você</h2>
              <a href="#" class="text-sm text-blue-600 hover:underline">Mais</a>
            </div>
  
            <div class="space-y-2">
              @foreach ($usersToFollow as $user)
                <div class="p-2 rounded-md cursor-pointer flex items-center justify-between gap-2 hover:bg-gray-100 transition-colors">
                  <a href="{{ route('profile.show', $user) }}" class="cursor-pointer flex items-center gap-2">
                    <x-profile.avatar :user="$user" size="w-10 h-10"/>
                    <div class="flex flex-col">
                      <span class="text-sm font-medium text-gray-800">{{ $user->name }}</span>
                      <span class="text-xs text-gray-500">{{ $user->posts->count() }} posts</span>
                    </div>
                  </a>
                  <x-ui.follow-button :$user/>
                </div>
              @endforeach
            </div>
          </x-ui.panel>
        </div>
      </div>

    </x-section>
  </div>
</x-layout>

<script src="{{ Vite::asset('resources/js/components/follow-button.js') }}"></script>