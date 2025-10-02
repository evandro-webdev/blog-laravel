<x-layout>
  <div 
    class="fixed top-0 left-0 h-1 bg-blue-600 z-50 transition-all duration-300" 
    x-data="{ width: '0%' }"
    x-init="
      window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset;
        const docHeight = document.body.offsetHeight - window.innerHeight;
        const scrollPercent = (scrollTop / docHeight) * 100;
        width = Math.min(scrollPercent, 100) + '%';
      })
    "
    :style="`width: ${width}`"
  >
  </div>

  <div 
    class="fixed left-4 top-1/2 -translate-y-1/2 z-40 hidden lg:flex flex-col gap-3"
    x-data="{ showActions: false }"
    x-init="
      window.addEventListener('scroll', () => {
        showActions = window.pageYOffset > 400;
      })
    "
    x-show="showActions"
    x-transition
  >
    <button 
      @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
      class="p-3 rounded-full bg-white dark:bg-gray-700 shadow-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
    >
      <x-ui.icons.arrow-up class="text-gray-600 dark:text-white"/>
    </button>

    <div class="relative" x-data="{ open: false }">
      <button 
        @click="open = !open"
        class="p-3 rounded-full bg-white dark:bg-gray-700 shadow-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
      >
        <x-ui.icons.font-size class="text-gray-600 dark:text-white"/>
      </button>
        
      <div 
        x-show="open" @click.away="open = false" 
        x-transition
        class="ml-2 rounded-lg text-gray-600 dark:text-white absolute left-full top-0 bg-white dark:bg-gray-700 shadow-lg p-2 whitespace-nowrap"
      >
        <div class="space-y-1">
          <button 
            @click="document.documentElement.style.fontSize = '14px'; open = false"
            class="block px-3 py-1 rounded text-sm hover:bg-gray-100 dark:hover:bg-gray-800"
          >
            Pequeno
          </button>
          <button 
            @click="document.documentElement.style.fontSize = '16px'; open = false"
            class="block px-3 py-1 rounded text-sm hover:bg-gray-100 dark:hover:bg-gray-800"
          >
            Normal
          </button>
          <button 
            @click="document.documentElement.style.fontSize = '18px'; 
            open = false"
            class="block px-3 py-1 rounded text-sm hover:bg-gray-100 dark:hover:bg-gray-800"
          >
            Grande
          </button>       
        </div>
      </div>
    </div>
  </div>

  <main class="min-h-screen">
    <header class="relative bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 lg:pt-16">
        {{-- <nav class="mb-8" aria-label="Breadcrumb">
          <ol class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
            <li><a href="/" class="hover:text-blue-600 transition-colors">Home</a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="/blog" class="hover:text-blue-600 transition-colors">Blog</a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="/categories/{{ $post->category->slug }}" class="hover:text-blue-600 transition-colors">{{ $post->category->name }}</a></li>
          </ol>
        </nav> --}}

        <div class="mb-4">
          <x-ui.badge small>
            {{ $post->category->name }}
          </x-ui.badge>
        </div>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white leading-tight mb-6">
          {{ $post->title }}
        </h1>

        @if($post->excerpt)
          <p class="text-xl text-gray-600 dark:text-gray-300 leading-relaxed mb-8 max-w-3xl">
            {!! $post->excerpt !!}
          </p>
        @endif

        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 dark:text-gray-400 mb-8">
          <div class="flex items-center gap-2">
            <x-profile.avatar :user="$post->user" size="w-8 h-8"/>
            <span>Por <a href="/{{ $post->user->username }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 font-medium">{{ $post->user->name }}</a></span>
          </div>

          <div class="flex items-center gap-1">
            <x-ui.icons.calendar size="w-4 h-4" stroke="2"/>
            <time datetime="{{ $post->created_at }}">
              {{ $post->created_at->translatedFormat('d \d\e F, Y') }}
            </time>
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
          <div class="flex flex-wrap gap-2 mb-8">
            @foreach ($post->tags as $tag)
              <a 
                href="/tags/{{ $tag->slug }}" 
                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
              >
                #{{ $tag->name }}
              </a>
            @endforeach
          </div>
        @endif
      </div>
    </header>

    @if($post->image)
      <section class="bg-white dark:bg-gray-800 py-12">
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
    @endif

    <div class="bg-white dark:bg-gray-800">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
          <article class="lg:col-span-3">
            <div class="prose prose-lg prose-gray dark:prose-invert max-w-none">
              {!! $post->content !!}
            </div>

            <footer class="mt-6 pt-2 space-y-4">
              <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                <div class="flex flex-col items-center">
                  <x-profile.avatar :user="$post->user" size="w-16 h-16"/>
                  <h3 class="mt-2 font-semibold text-gray-900 dark:text-white mb-2">{{ $post->user->name }}</h3>
                </div>
                @if($post->user->bio)
                  <p class="text-sm text-center text-gray-600 dark:text-gray-300 mb-4">{{ $post->user->bio }}</p>
                @endif
                <div class="flex justify-center gap-4 text-sm text-blue-600 dark:text-blue-400  ">
                  <span>{{ $post->user->posts()->where('published', true)->count() }} posts</span>
                  <span>{{ $post->user->getFollowersCount() }} seguidores</span>
                </div>
              </div>

              @auth
                <div class="pb-4 border-b border-gray-200 dark:border-gray-700 flex flex-wrap gap-3">
                  <button class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                    </svg>
                    Salvar
                  </button>

                  <button class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Marcar como lido
                  </button>

                  <button class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                    </svg>
                    Compartilhar
                  </button>
                </div>
              @endauth
              <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                @if($post->updated_at != $post->created_at)
                  <p class="text-sm text-gray-500 dark:text-gray-400">
                    Última atualização: {{ $post->updated_at->translatedFormat('d \d\e F, Y \à\s H:i') }}
                  </p>
                @endif

                <div class="flex gap-2">
                  <button class="p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                    </svg>
                  </button>
                  <button class="p-2 bg-blue-800 text-white rounded-lg hover:bg-blue-900 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                  </button>
                  <button class="p-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                    </svg>
                  </button>
                </div>
              </div>
            </footer>
          </article>

          <aside class="lg:col-span-1">
            <div class="sticky top-4 space-y-8">
              <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Índice</h3>
                <nav class="space-y-2">
                  <a href="#introducao" class="block text-sm text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">Introdução</a>
                  <a href="#desenvolvimento" class="block text-sm text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">Desenvolvimento</a>
                  <a href="#conclusao" class="block text-sm text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">Conclusão</a>
                </nav>
              </div>

              <div class="p-4 rounded-xl bg-blue-50 dark:bg-blue-900">
                <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Newsletter</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Receba os melhores conteúdos direto no seu email</p>
                <form class="space-y-3">
                  <input 
                    type="email" 
                    placeholder="Seu melhor email" 
                    class="w-full px-3 py-2 dark:text-white bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  >
                    <button 
                      type="submit" 
                      class="w-full px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors"
                    >
                      Inscrever-se
                    </button>
                </form>
              </div>

              <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Posts Populares</h3>
                <div class="space-y-4">
                  @foreach ($trendingPosts as $post)
                    <a href="{{ route('posts.show', $post) }}" class="block">
                      <h4
                        title="{{ $post->title }}"
                        class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-blue-600 transition-colors line-clamp-2"
                      >
                        {{ $post->title }}
                      </h4>
                      <time datetime="{{ $post->created_at }}" class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        {{ $post->created_at->translatedFormat('d \d\e F, Y') }}
                      </time>
                    </a>
                  @endforeach
                </div>
              </div>

            </div>
          </aside>
        </div>
      </div>
    </div>

    <section class="py-12 bg-gray-50 dark:bg-gray-900">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div x-data="{ count: {{ $post->comments->count() }} }" class="space-y-8">
          <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
              Comentários (<span x-text="count"></span>)
            </h2>
            <button class="text-sm text-gray-500 dark:text-gray-400 hover:text-blue-600 transition-colors">
              Ordenar por: Mais recentes
            </button>
          </div>

          @auth
            <x-blog.comment.comment-create-form :$post/>
          @else
            <x-ui.auth-prompt message="Faça login para comentar"/>
          @endauth

          <x-blog.comment.comment-list :comments="$post->comments" :$post/>
        </div>
      </div>
    </section>

    @if($relatedPosts->count() > 0)
        <section class="bg-white dark:bg-gray-800 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Artigos relacionados</h2>
                    <p class="text-lg text-gray-600 dark:text-gray-300">Continue sua leitura com estes conteúdos similares</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($relatedPosts as $relatedPost)
                        <article class="bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow group">
                            @if($relatedPost->image)
                                <div class="aspect-video overflow-hidden">
                                    <img src="{{ asset('storage/' . $relatedPost->image) }}" 
                                          alt="{{ $relatedPost->title }}"
                                          class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-medium rounded">
                                        {{ $relatedPost->category->name }}
                                    </span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $relatedPost->created_at->translatedFormat('d M') }}
                                    </span>
                                </div>
                                
                                <h3 class="font-semibold text-gray-900 dark:text-white mb-3 line-clamp-2">
                                    <a href="/posts/{{ $relatedPost->slug }}" class="hover:text-blue-600 transition-colors">
                                        {{ $relatedPost->title }}
                                    </a>
                                </h3>
                                
                                @if($relatedPost->excerpt)
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">
                                        {{ $relatedPost->excerpt }}
                                    </p>
                                @endif
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <img src="{{ $relatedPost->user->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($relatedPost->user->name).'&background=6366f1&color=white' }}" 
                                              alt="{{ $relatedPost->user->name }}"
                                              class="w-6 h-6 rounded-full">
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $relatedPost->user->name }}</span>
                                    </div>
                                    
                                    <div class="flex items-center gap-3 text-xs text-gray-500 dark:text-gray-400">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            {{ number_format($relatedPost->views->count()) }}
                                        </span>
                                        
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                            </svg>
                                            {{ $relatedPost->comments->count() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="py-16 bg-blue-600 dark:bg-blue-800">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="max-w-2xl mx-auto">
          <h2 class="mb-4 text-3xl font-bold text-white">Não perca nenhum conteúdo</h2>
          <p class="mb-8 text-xl text-blue-100">
            Receba os melhores artigos sobre desenvolvimento, dicas e tutoriais direto no seu email
          </p>
          
          <form class="max-w-md mx-auto flex flex-col sm:flex-row gap-4">
            <x-ui.forms.input type="email" name="email" placeholder="Seu melhor email"/>
            <button
              type="submit" 
              class="px-6 py-3 bg-white text-blue-600 font-medium rounded-lg hover:bg-gray-100 transition-colors"
            >
              Inscrever-se
            </button>
          </form>
          
          <p class="text-sm text-blue-200 mt-4">
            Sem spam. Cancele quando quiser.
          </p>
        </div>
      </div>
    </section>

    <x-ui.toast/>
  </main>
</x-layout>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });
  });
</script>