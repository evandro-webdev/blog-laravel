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

            <x-home.users-list :users="$usersToFollow" follow/>
          </section>

          @auth
            <section>
              <x-section-heading
                title="Seguindo"
                link="#"
                size="sm"
                class="mb-4"
              />

            <x-home.users-list :users="$user->following"/>
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

      <x-ui.toast/>
    </x-section>
  </div>
</x-layout>

<script src="{{ Vite::asset('resources/js/components/action-button.js') }}"></script>