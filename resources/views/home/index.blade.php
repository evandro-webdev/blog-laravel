<x-layout>
  <div class="bg-white dark:bg-slate-800">
    <x-section>
      <div class="flex flex-col lg:flex-row gap-12">
        <div class="flex-1 min-w-0">
          <x-home.tab-links :$tab/>

          <div class="mt-6">
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

        <aside class="w-full lg:w-72 flex flex-col gap-10 shrink-0">
          <section>
            <x-section-heading
              title="Sugerido para você"
              link="#"
              size="sm"
              class="mb-4"
            />

            <div class="space-y-1.5">
              @foreach ($usersToFollow as $userToFollow)
                <div class="flex items-center justify-between p-2 rounded-md hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors group">
                  <a href="{{ route('profile.show', $userToFollow) }}" class="flex items-center gap-2">
                    <x-profile.avatar :user="$userToFollow" size="w-10 h-10"/>
                    <div>
                      <span class="block text-sm font-medium text-gray-800 dark:text-white">
                        {{ $userToFollow->name }}
                      </span>
                      <span class="block text-xs text-gray-500 dark:text-gray-400">
                        {{ $userToFollow->posts->count() }} posts
                      </span>
                    </div>
                  </a>
                  <x-ui.interactive.follow-button :user="$userToFollow"/>
                </div>
              @endforeach
            </div>
          </section>

          @auth
            <section>
              <x-section-heading
                title="Seguindo"
                link="#"
                size="sm"
                class="mb-4"
              />

              <div class="space-y-1.5">
                @foreach ($user->following as $following)
                  <a href="{{ route('profile.show', $following) }}" class="flex items-center gap-2 p-2 rounded-md hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors">
                    <x-profile.avatar :user="$following" size="w-10 h-10"/>
                    <div>
                      <span class="block text-sm font-medium text-gray-800 dark:text-white">
                        {{ $following->name }}
                      </span>
                      <span class="block text-xs text-gray-500 dark:text-gray-400">
                        {{ $following->posts->count() }} posts
                      </span>
                    </div>
                  </a>
                @endforeach
              </div>
            </section>
          @endauth

          <section>
            <x-section-heading
              title="Top posts deste mês"
              link="#"
              size="sm"
              class="mb-4"
            />

            <div class="space-y-3">
              @foreach ($trendingPostsThisMonth as $trendingPost)
                <div class="flex items-center gap-3">
                  <div class="flex items-center justify-center shrink-0 w-8 h-8 rounded-full bg-blue-600 text-white text-sm font-semibold">
                    {{ $loop->iteration }}
                  </div>
                  <h3 class="text-sm font-medium text-gray-800 dark:text-white hover:underline line-clamp-2">
                    <a href="{{ route('posts.show', $trendingPost) }}">
                      {{ $trendingPost->title }}
                    </a>
                  </h3>
                </div>
              @endforeach
            </div>
          </section>
        </aside>
      </div>

    </x-section>
  </div>
</x-layout>

<script src="{{ Vite::asset('resources/js/components/action-button.js') }}"></script>