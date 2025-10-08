@props([
  'post',
  'comment'
])

<div class="mb-2 flex items-center gap-2 md:gap-4">
  <h4 class="text-sm md:text-base font-medium text-gray-900 dark:text-white">{{ $comment->user->name }}</h4>
  <x-ui.utilities.datetime :date="$comment->created_at" class="text-xs md:text-sm text-gray-500 dark:text-gray-400"/>

  @if($comment->user->id === $post->user->id)
    <span class="px-2 py-1 rounded text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
      Autor
    </span>
  @endif
</div>