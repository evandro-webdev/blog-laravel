<article class="overflow-hidden flex flex-col sm:flex-row group">
  <x-blog.post.post-thumbnail :image="$post->image" :title="$post->title" class="sm:w-1/3 sm:aspect-[4/3] object-cover"/>
  
  <div class="p-4 rounded-b-md sm:rounded-l-none sm:rounded-t-md space-y-5 flex flex-col flex-1 justify-center"
  >
    <div class="flex items-center gap-2">
      <a href="{{ route('profile.show', $post->user) }}" class="flex items-center gap-2">
        <x-profile.avatar :user="$post->user" size="w-6 h-6"/>
        <span class="text-xs font-medium text-gray-700 dark:text-gray-100">{{ $post->user->name }}</span>
      </a>
      <span class="text-gray-600 dark:text-gray-100">·</span>
      <x-ui.utilities.datetime 
        :date="$post->created_at"
        class="text-xs text-gray-600 dark:text-gray-100"
      />
    </div>

    <a href="{{ route('posts.show', $post) }}" class="space-y-2">
      <h3 
        title="{{ $post->title }}" 
        class="font-semibold text-xl text-gray-800 group-hover:text-blue-600 dark:text-white dark:group-hover:text-blue-400 transition-colors line-clamp-2"
      >
        {{ $post->title }}
      </h3>
      <p class="text-sm text-gray-600 dark:text-gray-200 line-clamp-2">{!! $post->excerpt !!}</p>
    </a>

    <div class="flex items-center justify-between">
      <x-ui.base.badge href="#" small variant="blue">{{ $post->category->name }}</x-ui.badge>
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