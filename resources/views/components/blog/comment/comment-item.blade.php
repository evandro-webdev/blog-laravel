<div 
  x-data="{ 
    editing: false, 
    content: '{{ addslashes($comment->content) }}',
    menuOpen: false,
    updating: false,
    
    updateComment(id) {
      this.updating = true;
      this.$dispatch('update-comment', { 
        id, 
        content: this.content 
      });
    },

    deleteComment(id) {
      if (confirm('Tem certeza que deseja excluir este comentário?')) {
        this.$dispatch('delete-comment', { id });
      }
      this.menuOpen = false;
    },

    cancelEdit() {
      this.editing = false;
      this.content = '{{ addslashes($comment->content) }}';
    }
  }"
  id="comment-{{ $comment->id }}" 
  class="flex gap-3" 
>
  <x-profile.avatar :user="$comment->user"/>

  <article class="p-4 space-y-3 rounded-md border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 flex-1">
    <x-blog.comment.comment-header :$comment />

    <div>
      <x-blog.comment.comment-content/>
      <x-blog.comment.comment-edit-form :$comment/>
    </div>

  </article>
</div>