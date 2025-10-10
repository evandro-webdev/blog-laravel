<article class="rounded-md overflow-hidden flex flex-col sm:flex-row group">
  <x-blog.post.post-thumbnail :image="$post->image" :title="$post->title" class="sm:w-1/3 sm:aspect-[4/3] object-cover"/>
  
  <div class="p-4 rounded-b-md sm:rounded-l-none sm:rounded-t-md 
    border-1 border-t-0 sm:border-t-1 sm:border-l-0 
    border-gray-200 dark:border-gray-700 space-y-4 bg-white dark:bg-slate-800 flex flex-col flex-1 justify-center"
  >
    <div class="flex items-center gap-2">
      <div class="flex items-center gap-2">
        <x-profile.avatar :user="$post->user" size="w-7 h-7"/>
        <span class="text-sm font-medium text-gray-700 dark:text-gray-100">{{ $post->user->name }}</span>
      </div>
      <span class="text-gray-600 dark:text-gray-100">·</span>
      <x-ui.utilities.datetime 
        :date="$post->created_at"
        class="text-xs text-gray-600 dark:text-gray-100"
      />
    </div>

    <a href="{{ route('posts.show', $post) }}" class="space-y-1">
      <h3 class="font-bold text-xl text-gray-800 dark:text-white">{{ $post->title }}</h3>
      <p class="text-gray-600 dark:text-gray-100 line-clamp-2">{!! $post->excerpt !!}</p>
    </a>

    <div class="flex items-center justify-between">
      <x-ui.base.badge href="#" small>{{ $post->category->name }}</x-ui.badge>
      <div class="text-gray-600 dark:text-gray-100 flex items-center gap-2">
        <div class="flex items-center gap-1">
          <x-ui.icons.save size="w-4 h-4"/>
          <span class="text-xs">{{ $post->savedBy->count() }}</span>
        </div>
        <div class="flex items-center gap-1">
          <x-ui.icons.comment size="w-4 h-4"/>
          <span class="text-xs">{{ $post->comments->count() }}</span>
        </div>
      </div>
    </div>
  </div>
</article>