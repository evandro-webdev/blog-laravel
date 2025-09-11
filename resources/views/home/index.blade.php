<x-layout>
  <div class="bg-gray-50">
    <x-section>
      <x-page-heading 
        title="{{ $user ? 'Bem vindo de volta, ' . $user->name : 'Bem vindo' }} " 
        subtitle="Veja o que acontece na área de tecnologia"
        class="mb-4"
      />

      <div class="flex flex-col gap-6 lg:flex-row">
        <x-ui.tab-container class="space-y-4" default-tab="{{ $user ? 'personal-feed' : 'trending-feed' }}">
          <x-slot:tabs>
            <x-ui.tab value="personal-feed" x-model="tab" icon="users">Seguindo</x-ui.tab>
            <x-ui.tab value="trending-feed" x-model="tab" icon="world">Em alta</x-ui.tab>
          </x-slot:tabs>

          <x-slot:content>
            @auth
              <x-home.tabs.tab-personal-feed :$sort :$postsFromFollowing/>
            @else
              <div class="p-6 text-center border border-gray-200 rounded bg-white flex flex-col items-center gap-4" x-show="tab === 'personal-feed'">
                <p class="text-gray-600">Faça login para ver os posts de quem você segue.</p>
                <x-ui.forms.button href="/login" small>Entrar</x-ui.forms.button>
                <p class="text-sm text-gray-500">
                  Ainda não tem conta?
                  <a href="/register" class="text-blue-600 hover:underline">Cadastre-se</a>
                </p>
              </div>
            @endauth
            <x-home.tabs.tab-trending-feed :$sort :$popularPosts/>
          </x-slot:content>
        </x-ui.tab-container>

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