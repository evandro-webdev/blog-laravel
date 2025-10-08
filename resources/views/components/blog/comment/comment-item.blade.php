@props([
  'post',
  'comment'
])

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
  class="p-4 rounded-xl bg-white dark:bg-slate-800 shadow-sm"
>
  <div class="flex gap-3 md:gap-4">
    <x-profile.avatar :user="$comment->user" size="w-8 h-8"/>
      
    <div class="flex-1">
      <x-blog.comment.comment-header :$comment :$post/>

      <x-blog.comment.comment-content/>
      <x-blog.comment.comment-edit-form :$comment/>
        
      <x-blog.comment.comment-footer :$comment/>
    </div>
  </div>
</div>