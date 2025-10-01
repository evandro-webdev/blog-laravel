<div 
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
  x-ref="commentsList"
  class="space-y-6"
>
  @foreach ($comments as $comment)
    <x-blog.comment.comment-item :$comment :$post/>
  @endforeach
</div>