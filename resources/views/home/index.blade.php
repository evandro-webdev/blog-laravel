<x-layout>
  <div class="bg-white dark:bg-slate-800">
    <x-section>
      <div class="flex flex-col gap-6 lg:flex-row">
        <div class="flex-1">
          <x-home.tab-links :$tab/>

          <div>
            @if ($tab === 'personal-feed')
              @auth
                <x-home.tabs.tab-personal-feed :$sort :$posts/>
              @else
                <x-ui.utilities.auth-prompt message="Faça login para ver os posts de quem você segue."/>
              @endauth
            @endif

            @if ($tab === 'trending-feed')
              <x-home.tabs.tab-trending-feed :$sort :$posts/>
            @endif
          </div>
        </div>

        <div class="flex flex-col gap-10 sm:flex-row sm:flex-wrap lg:flex-col lg:min-w-xs lg:max-w-3">
          <div class="flex-1 lg:flex-0">
            <x-section-heading
              title="Sugerido para você"
              link="#"
              size="sm"
              class="mb-6"
            />
  
            <div class="space-y-2">
              @foreach ($usersToFollow as $userToFollow)
                <div class="p-2 rounded-md cursor-pointer flex items-center justify-between gap-2 hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors">
                  <a href="{{ route('profile.show', $userToFollow) }}" class="cursor-pointer flex items-center gap-2">
                    <x-profile.avatar :user="$userToFollow" size="w-10 h-10"/>
                    <div class="flex flex-col">
                      <span class="text-sm font-medium text-gray-800 dark:text-white">{{ $userToFollow->name }}</span>
                      <span class="text-xs text-gray-500 dark:text-gray-400">{{ $userToFollow->posts->count() }} posts</span>
                    </div>
                  </a>
                  <x-ui.interactive.follow-button :user="$userToFollow"/>
                </div>
              @endforeach
            </div>
          </div>

          @auth
            <div class="flex-1 lg:flex-0">
              <x-section-heading
                title="Seguindo"
                link="#"
                size="sm"
                class="mb-6"
              />
      
              <div class="space-y-2">
                @foreach ($user->following as $following)
                  <a href="{{ route('profile.show', $following) }}" class="p-2 rounded-md cursor-pointer flex items-center gap-2 hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors">
                    <x-profile.avatar :user="$following" size="w-10 h-10"/>
                    <div class="flex flex-col">
                      <span class="text-sm font-medium text-gray-800 dark:text-white">{{ $following->name }}</span>
                      <span class="text-xs text-gray-500 dark:text-gray-400">{{ $following->posts->count() }} posts</span>
                    </div>
                  </a>
                @endforeach
              </div>
            </div>
          @endauth

          <div class="w-full">
            <x-section-heading
              title="Top posts deste mês"
              link="#"
              size="sm"
              class="mb-6"
            />

            <div class="space-y-5">
              @foreach ($trendingPostsThisMonth as $trendingPost)
                <div class="flex items-center gap-2">
                  
                  <div class="shrink-0 flex items-center justify-center w-8 h-8 rounded-full 
                              bg-blue-600 text-white text-sm font-bold">
                    {{ $loop->iteration }}
                  </div>

                  <h3 class="text-sm font-medium hover:underline line-clamp-2 text-gray-800 dark:text-white">
                    <a href="{{ route('posts.show', $trendingPost) }}">
                      {{ $trendingPost->title }}
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

<script src="{{ Vite::asset('resources/js/components/action-button.js') }}"></script>