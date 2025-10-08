<div class="bg-white dark:bg-slate-800 rounded-xl p-4 shadow-sm">
  <div class="flex gap-4">
    <x-profile.avatar :user="Auth::user()"/>

    <form 
      @submit.prevent="
        axios.post('{{ route('comments.store', $post) }}', {
          content: $refs.content.value
        })
        .then((res) => {
          $refs.content.value = '';
          $refs.commentsList.insertAdjacentHTML('afterbegin', res.data.data.html);
          count++;
          $dispatch('notify', 'Comentário adicionado!');
        })
        .catch((err) => {
          console.error('Erro completo:', err.response ?? err);
          $dispatch('notify', 'Erro ao enviar comentário');
        });
      "
      class="flex-1 space-y-4"
    >
      @csrf
      <x-ui.forms.input x-ref="content" name="content" as="textarea" placeholder="Compartilhe sua opinião de forma respeitosa e construtiva..."/>

      <div class="flex items-center justify-end">
        <x-ui.forms.button size="sm" icon="send">Publicar comentário</x-ui.forms.button>
      </div>
    </form>
  </div>
</div>