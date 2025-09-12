<x-layout class="dark:bg-gray-950">
  <section class="max-w-[960px] py-16 px-5 mx-auto">
  
    <header class="text-center max-w-[720px] mx-auto">
      <time datetime="{{ $post->created_at }}" class="block mb-1 text-sm text-gray-500 dark:text-gray-300">
        Publicado em {{ $post->created_at->translatedFormat('d \d\e F, Y') }}
      </time>

      <h1 class="text-4xl font-bold text-gray-900 dark:text-white leading-tight">
        {{ $post->title }}
      </h1>

      @if($post->excerpt)
        <p class="mt-4 text-lg text-gray-700 dark:text-gray-100 leading-relaxed">
          {{ $post->excerpt }}
        </p>
      @endif

      @if($post->tags->count())
        <div class="flex justify-center flex-wrap gap-2 mt-5">
          @foreach ($post->tags as $tag)
            <x-ui.badge small>{{ $tag->name }}</x-ui.badge>
          @endforeach
        </div>
      @endif
    </header>

    @if($post->image)
      <figure class="mx-auto my-10 max-w-[820px] rounded-lg overflow-hidden shadow-sm">
        <img 
          src="{{ asset('storage/' . $post->image) }}" 
          alt="Imagem de capa do post: {{ $post->title }}"
          class="w-full object-cover"
          loading="lazy"
        >
      </figure>
    @endif

    <article class="max-w-[720px] mx-auto prose prose-lg prose-gray dark:text-gray-100">
      {!! $post->content !!}
    </article>

    <div class="max-w-[720px] mx-auto mt-6 py-6 border-y-1 border-gray-200 dark:border-gray-800 flex items-center gap-2">
      @auth
        <x-ui.read-button :$post/>
        <x-ui.save-button :$post/>
      @endauth
    </div>
  </section>

  <section class="w-full max-w-[960px] py-20 px-5 mx-auto" aria-label="Seção de comentários">
    <div 
      x-data="{ count: {{ $post->comments->count() }} }"
      class="max-w-[700px] mx-auto space-y-6"
    >
      
      <x-section-heading>
        Comentários (<span x-text="count"></span>)
      </x-section-heading>

      <x-ui.panel class="flex gap-2">

        <x-profile.avatar :user="Auth::user()"/>

        <form 
          x-data
          @submit.prevent="
            axios.post('{{ route('comments.store', $post) }}', {
              content: $refs.content.value
            })
            .then(res => {
              $refs.content.value = '';
              document.querySelector('#comments-list').insertAdjacentHTML('afterbegin', res.data.html);
              count++;
              $dispatch('notify', 'Comentário adicionado!');
            })
            .catch(() => $dispatch('notify', 'Erro ao enviar comentário'));
          "
          class="flex-1 space-y-4"
        >
          @csrf

          <label for="content" class="sr-only">Comentário</label>
          <x-ui.forms.input x-ref="content" name="content" as="textarea" placeholder="Compartilhe sua opinião"/>

          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <span class="text-xs text-gray-500 dark:text-gray-200">
              Seja respeitoso e construtivo em seus comentários
            </span>
            <x-ui.forms.button size="sm">Postar</x-ui.forms.button>
          </div>
        </form>

      </x-ui.panel>

      <div 
        x-data 
        @update-comment.window="
          axios.put('/comments/' + $event.detail.id, { content: $event.detail.content })
            .then(() => $dispatch('notify', 'Comentário atualizado!'))
            .catch(() => $dispatch('notify', 'Erro ao atualizar comentário'));
        "
        @delete-comment.window="
          axios.delete('/comments/' + $event.detail.id)
            .then(() => {
              document.getElementById('comment-' + $event.detail.id).remove();
              count--;
              $dispatch('notify', 'Comentário excluído!');
            })
            .catch(() => $dispatch('notify', 'Erro ao excluir comentário'));
        "
        id="comments-list"
        class="space-y-6"
      >
        @foreach ($post->comments as $comment)
          <x-blog.comments.comment-item :$comment/>
        @endforeach
      </div>

      <x-ui.toast/>
    </div>
  </section>

  <section class="max-w-[960px] py-20 px-5 mx-auto">
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      @foreach ($relatedPosts as $post)
        <x-blog.post.post-card :$post/>
      @endforeach
    </div>
  </section>
</x-layout>

<script src="{{ Vite::asset('resources/js/components/read-button.js') }}"></script>
<script src="{{ Vite::asset('resources/js/components/save-button.js') }}"></script>