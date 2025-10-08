@props([
  'post',
  'comment'
])

<div class="flex items-center gap-2 mb-2">
  <h4 class="font-medium text-gray-900 dark:text-white">{{ $comment->user->name }}</h4>
  <x-ui.utilities.datetime :date="$comment->created_at" class="text-sm text-gray-500 dark:text-gray-400"/>

  @if($comment->user->id === $post->user->id)
    <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-medium rounded">
      Autor
    </span>
  @endif
</div>