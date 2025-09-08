<div id="comment-{{ $comment->id }}" class="flex gap-3" 
  x-data="{ 
    editing: false, 
    content: '{{ addslashes($comment->content) }}',
    menuOpen: false
}">

  <x-profile.avatar :user="$comment->user"/>

  <article id="comment-{{ $comment->id }}" class="p-4 rounded-md bg-gray-50 border border-gray-200 flex-1 space-y-3">

    <header class="flex items-center justify-between">
      <div class="flex items-center gap-2">
        <a href="{{ route('profile.show', $comment->user) }}" 
           class="font-medium text-gray-800 hover:underline">
          {{ $comment->user->name }}
        </a>
        <time class="text-xs text-gray-600" datetime="{{ $comment->created_at }}">
          {{ $comment->created_at->diffForHumans() }}
        </time>
      </div>

      @if (Auth::id() === $comment->user_id)
        <div class="relative" @click.away="menuOpen=false">
          <button @click="menuOpen=!menuOpen" 
            class="p-1 rounded hover:bg-gray-100" 
            aria-label="Opções do comentário">
              <x-ui.icons.ellipsis class="text-gray-700"/>
          </button>

          <div x-show="menuOpen" x-cloak 
            class="absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded-md shadow-md z-10">
              <button @click="editing=true; menuOpen=false"
                class="w-full px-3 py-2 text-left text-blue-600 flex items-center gap-2 hover:bg-blue-50">
                  <x-ui.icons.edit/>
                  <span class="font-medium">Editar</span>
              </button>
              <button @click="
                  if(confirm('Excluir comentário?')) {
                    $dispatch('delete-comment', { id: {{ $comment->id }} });
                  }
                  menuOpen=false
                "
                class="w-full px-3 py-2 text-left text-red-600 flex items-center gap-2 hover:bg-red-50">
                  <x-ui.icons.trash/>
                  <span class="font-medium">Excluir</span>
              </button>
          </div>
        </div>
      @endif
    </header>

    <div>
      <p class="text-gray-700 text-sm leading-relaxed" 
        x-show="!editing" 
        x-text="content"></p>

      <form x-show="editing" x-cloak
        @submit.prevent="
          $dispatch('update-comment', { id: {{ $comment->id }}, content: content });
          editing = false;
        "
        class="space-y-2"
      >
        <x-ui.forms.input x-model="content" name="content" as="textarea"/>
        <div class="flex gap-2 justify-end">
          <button type="button" @click="editing=false"
            class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 text-sm"
          >
            Cancelar
          </button>
          <button type="submit"
            class="px-3 py-1 rounded bg-blue-600 text-white hover:bg-blue-700 text-sm"
          >
            Salvar
          </button>
        </div>
      </form>
    </div>

  </article>
</div>
