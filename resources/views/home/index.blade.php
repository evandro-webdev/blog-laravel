<x-layout>
  <div class="bg-gray-50 dark:bg-gray-950">
    <x-section>
      <x-page-heading 
        title="{{ $user ? 'Bem vindo de volta, ' . $user->name : 'Bem vindo' }} " 
        subtitle="Veja o que acontece na área de tecnologia"
        class="mb-8"
      />

      <div class="flex flex-col gap-6 lg:flex-row">
        <div class="flex-1">
          <div class="mb-4 flex border-b border-gray-200 dark:border-gray-600">
            <a 
              href="{{ request()->url() }}?tab=personal-feed&sort=recent" 
              class="px-4 py-2 -mb-px border-b-2 font-medium text-sm flex items-center gap-2
                {{ $tab === 'personal-feed' 
                    ? 'border-blue-600 text-blue-600 dark:border-blue-400 dark:text-blue-400' 
                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:border-gray-600' }}"
            >
              <x-ui.icons.users />
              <span>Seguindo</span>
            </a>

            <a 
              href="{{ request()->url() }}?tab=trending-feed&sort=popular" 
              class="px-4 py-2 -mb-px border-b-2 font-medium text-sm flex items-center gap-2
                {{ $tab === 'trending-feed' 
                    ? 'border-blue-600 text-blue-600 dark:border-blue-400 dark:text-blue-400' 
                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:border-gray-600' }}"
            >
              <x-ui.icons.world />
              <span>Em alta</span>
            </a>
          </div>

          <div>
            @if ($tab === 'personal-feed')
              @auth
                <x-home.tabs.tab-personal-feed :$sort :$posts/>
              @else
                <x-ui.panel class="text-center flex flex-col items-center gap-4">
                  <p class="text-gray-600 dark:text-white">Faça login para ver os posts de quem você segue.</p>
                  <x-ui.forms.button href="/login" icon="enter" size="sm">Entrar</x-ui.forms.button>
                  <p class="text-sm text-gray-500 dark:text-gray-100">
                    Ainda não tem conta?
                    <a href="/register" class="text-blue-600 dark:text-blue-400 hover:underline">Cadastre-se</a>
                  </p>
                </x-ui.panel>
              @endauth
            @endif

            @if ($tab === 'trending-feed')
              <x-home.tabs.tab-trending-feed :$sort :$posts/>
            @endif
          </div>
        </div>

        <div class="flex flex-col gap-6 sm:flex-row lg:flex-col lg:min-w-xs lg:max-w-3">
          @auth
            <x-ui.panel class="flex-1 lg:flex-0">
              <x-section-heading
                title="Seguindo"
                link="#"
                size="sm"
                class="mb-6"
              />
      
              <div class="space-y-2">
                @foreach ($user->following as $following)
                  <a href="{{ route('profile.show', $following) }}" class="p-2 rounded-md cursor-pointer flex items-center gap-2 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <x-profile.avatar :user="$following" size="w-10 h-10"/>
                    <div class="flex flex-col">
                      <span class="text-sm font-medium text-gray-800 dark:text-white">{{ $following->name }}</span>
                      <span class="text-xs text-gray-500 dark:text-gray-400">{{ $following->posts->count() }} posts</span>
                    </div>
                  </a>
                @endforeach
              </div>
            </x-ui.panel>
          @endauth
  
          <x-ui.panel class="flex-1 lg:flex-0">
            <x-section-heading
              title="Sugerido para você"
              link="#"
              size="sm"
              class="mb-6"
            />
  
            <div class="space-y-2">
              @foreach ($usersToFollow as $user)
                <div class="p-2 rounded-md cursor-pointer flex items-center justify-between gap-2 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                  <a href="{{ route('profile.show', $user) }}" class="cursor-pointer flex items-center gap-2">
                    <x-profile.avatar :user="$user" size="w-10 h-10"/>
                    <div class="flex flex-col">
                      <span class="text-sm font-medium text-gray-800 dark:text-white">{{ $user->name }}</span>
                      <span class="text-xs text-gray-500 dark:text-gray-400">{{ $user->posts->count() }} posts</span>
                    </div>
                  </a>
                  <x-ui.follow-button :$user/>
                </div>
              @endforeach
            </div>
          </x-ui.panel>

          <div>
            <x-section-heading
              title="Top posts deste mês"
              link="#"
              size="sm"
              class="mb-6"
            />

            <div class="space-y-4">
              @foreach ($trendingPostsThisMonth as $post)
                <div class="flex items-center gap-3">
                  
                  <div class="shrink-0 flex items-center justify-center w-8 h-8 rounded-full 
                              bg-blue-600 text-white text-sm font-bold">
                    {{ $loop->iteration }}
                  </div>

                  <h3 class="text-gray-800 dark:text-white font-medium hover:underline line-clamp-2">
                    <a href="{{ route('posts.show', $post) }}">
                      {{ $post->title }}
                    </a>
                  </h3>
                </div>
              @endforeach
            </div>
          </div>

        </div>
      </div>

    </x-section>
  </div>
</x-layout>

<script src="{{ Vite::asset('resources/js/components/follow-button.js') }}"></script>