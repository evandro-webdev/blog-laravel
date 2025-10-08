<x-layout>
  <x-ui.base.progress-bar/>
  <x-blog.post.post-actions/>

  <main class="min-h-screen">
    <header class="relative border-b border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 lg:pt-16">
        <x-ui.base.badge href="/category/{{ $post->category->name }}" small>
          {{ $post->category->name }}
        </x-ui.base.badge>

        <h1 class="mt-4 mb-4 md:mb-6 text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white leading-tight">
          {{ $post->title }}
        </h1>

        <p class="max-w-3xl mb-6 md:mb-8 text-md sm:text-lg md:text-xl text-gray-600 dark:text-gray-300 leading-relaxed">
          {!! $post->excerpt !!}
        </p>

        <div class="mb-8 text-sm text-gray-500 dark:text-gray-400 flex flex-wrap items-center gap-4">
          <div class="flex items-center gap-2">
            <x-profile.avatar :user="$post->user" size="w-8 h-8"/>
            <a
              href="/{{ $post->user->username }}" 
              class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-500 transition-colors"
            >
              {{ $post->user->name }}
            </a>
          </div>

          <div class="flex items-center gap-1">
            <x-ui.icons.calendar size="w-4 h-4" stroke="2"/>
            <x-ui.utilities.datetime
              :date="$post->created_at" 
              format="d \d\e F, Y"
            />
          </div>

          <div class="flex items-center gap-1">
            <x-ui.icons.clock size="w-4 h-4" stroke="2"/>
            <span>{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min de leitura</span>
          </div>

          <div class="flex items-center gap-1">
            <x-ui.icons.eye size="w-4 h-4" stroke="2"/>
            <span>{{ number_format($post->views->count()) }} visualizações</span>
          </div>
        </div>

        @if($post->tags->count())
          <div class="mb-8 flex flex-wrap gap-2">
            @foreach ($post->tags as $tag)
              <x-ui.base.badge href="/tags/{{ $tag->slug }}" variant="white" small>#{{ $tag->name }}</x-ui.base.badge>
            @endforeach
          </div>
        @endif
      </div>
    </header>

    <section class="py-6 md:py-12 bg-white dark:bg-slate-800">
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <figure class="rounded-xl overflow-hidden shadow-lg">
          <img 
            src="{{ asset('storage/' . $post->image) }}" 
            alt="Imagem de capa do post: {{ $post->title }}"
            class="w-full h-64 sm:h-80 lg:h-96 object-cover"
            loading="lazy"
          >
        </figure>
      </div>
    </section>

    <div class="bg-white dark:bg-slate-800">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4 lg:py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
          <article class="lg:col-span-3">
            <div class="max-w-none prose prose-base sm:prose-md lg:prose-lg prose-gray dark:prose-invert">
              {!! $post->content !!}
            </div>

            <footer class="mt-6 pt-2 space-y-4">
              <div class="p-6 rounded-xl bg-gray-50 dark:bg-slate-900">
                <div class="flex flex-col items-center">
                  <x-profile.avatar :user="$post->user" size="w-16 h-16"/>
                  <a 
                    href="{{ route('profile.show', $post->user) }}"
                    class="mt-2 font-semibold text-gray-900 dark:text-white"
                  >
                    {{ $post->user->name }}
                  </a>
                </div>

                @if($post->user->bio)
                  <p class="[text-wrap:balance] my-4 text-sm text-center text-gray-600 dark:text-gray-300">{{ $post->user->bio }}</p>
                @endif

                <div class="text-sm flex justify-center gap-4 text-blue-600 dark:text-blue-500">
                  <span>{{ $post->user->posts()->where('published', true)->count() }} posts</span>
                  <span>{{ $post->user->getFollowersCount() }} seguidores</span>
                </div>
              </div>

              @auth
                <div class="pb-4 border-b border-gray-200 dark:border-gray-700 flex flex-wrap gap-3">
                  <x-ui.interactive.save-button :$post/>
                  <x-ui.interactive.read-button :$post/>
                </div>
              @endauth

              <div class="flex flex-wrap items-center justify-between gap-4">
                @if($post->updated_at != $post->created_at)
                  <x-ui.utilities.datetime
                    :date="$post->updated_at"
                    prefix="Ultima atualização: "
                    format="d \d\e F, Y \à\s H:i"
                    class="text-xs md:text-sm text-gray-500 dark:text-gray-400"
                  />
                @endif

                <div class="flex gap-2">
                  <button class="p-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                    </svg>
                  </button>
                  <button class="p-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                  </button>
                  <button class="p-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                    </svg>
                  </button>
                </div>
              </div>
            </footer>
          </article>

          <aside class="lg:col-span-1 hidden lg:block">
            <div class="sticky top-4 space-y-8">
              <div class="p-4 rounded-xl bg-gray-50 dark:bg-slate-700">
                <h3 class="font-semibold text-gray-800 dark:text-white mb-4">Índice</h3>
                <nav class="space-y-2">
                  <a href="#introducao" class="block text-sm text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">Introdução</a>
                  <a href="#desenvolvimento" class="block text-sm text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">Desenvolvimento</a>
                  <a href="#conclusao" class="block text-sm text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">Conclusão</a>
                </nav>
              </div>

              <div class="p-4 rounded-xl bg-gray-50 dark:bg-slate-700">
                <h3 class="font-semibold text-gray-800 dark:text-white mb-4">Posts Populares</h3>
                <div class="space-y-4">
                  @foreach ($trendingPosts as $trendingPost)
                    <a href="{{ route('posts.show', $trendingPost) }}" class="block">
                      <h4
                        title="{{ $trendingPost->title }}"
                        class="text-sm font-medium text-gray-700 dark:text-white group-hover:text-blue-600 transition-colors line-clamp-2"
                      >
                        {{ $trendingPost->title }}
                      </h4>
                      <x-ui.utilities.datetime
                        :date="$post->created_at" 
                        format="d \d\e F, Y"
                        class="mt-1 text-xs text-gray-600 dark:text-slate-300"
                      />
                    </a>
                  @endforeach
                </div>
              </div>

              <div class="p-4 rounded-xl bg-blue-50 dark:bg-blue-900">
                <div class="mb-4 space-y-2">
                  <h3 class="font-semibold text-gray-800 dark:text-white">Newsletter</h3>
                  <p class="text-sm text-gray-600 dark:text-gray-300">Receba os melhores conteúdos direto no seu email</p>
                </div>

                <form class="space-y-3">
                  <x-ui.forms.input type="email" name="email" placeholder="Seu melhor email" size="sm" variant="white"/>
                  <x-ui.forms.button size="sm" class="w-full">Inscrever-se</x-ui.forms.button>
                </form>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>

    <section class="py-12 bg-gray-50 dark:bg-slate-900">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div x-data="{ count: {{ $post->comments->count() }} }" class="space-y-8">
          <div class="flex flex-wrap items-center justify-between">
            <h2 
              x-text="count === 0 ? 'Seja o primeiro a comentar' : 'Comentários (' + count + ')'"
              class="text-2xl font-bold text-gray-800 dark:text-white"
            >
            </h2>
            <button class="text-xs text-gray-500 dark:text-gray-400 hover:text-blue-600 transition-colors">
              Mais recentes
            </button>
          </div>

          @auth
            <x-blog.comment.comment-create-form :$post/>
          @else
            <x-ui.utilities.auth-prompt message="Faça login para comentar"/>
          @endauth

          <x-blog.comment.comment-list :comments="$post->comments" :$post/>
        </div>
      </div>
    </section>

    @if($relatedPosts->count() > 0)
      <section class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="mb-12 text-center">
            <h2 class="mb-2 text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Artigos relacionados</h2>
            <p class="[text-wrap:balance] text-base md:text-lg text-gray-600 dark:text-gray-300">Continue sua leitura com estes conteúdos similares</p>
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($relatedPosts as $relatedPost)
              <x-blog.post.post-card-vertical :post="$relatedPost"/>
            @endforeach
          </div>
        </div>
      </section>
    @endif

    <section class="py-16 bg-blue-800">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="max-w-2xl mx-auto">
          <h2 class="mb-2 md:mb-4 text-xl sm:text-2xl md:text-3xl font-bold text-white">Não perca nenhum conteúdo</h2>
          <p class="[text-wrap:balance] mb-6 md:mb-8 text-sm sm:text-lg md:text-xl text-blue-100">
            Receba os melhores artigos sobre desenvolvimento, dicas e tutoriais direto no seu email
          </p>
          
          <form class="max-w-md mx-auto flex flex-col sm:flex-row gap-4">
            <x-ui.forms.input type="email" name="email" placeholder="Seu melhor email" variant="white"/>
            <x-ui.forms.button>Inscrever-se</x-ui.forms.button>
          </form>
          
          <p class="text-sm text-blue-200 mt-4">
            Sem spam. Cancele quando quiser.
          </p>
        </div>
      </div>
    </section>

    <x-ui.toast icon="comment"/>
  </main>
</x-layout>

<script src="{{ Vite::asset('resources/js/components/read-button.js') }}"></script>
<script src="{{ Vite::asset('resources/js/components/save-button.js') }}"></script>