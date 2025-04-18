@props(['post'])

<div class="flex items-start gap-6">
  <span class="text-lg font-black text-blue-300">1</span>
  <x-blog.post.thumbnail size="small" link="{{ $post->image }}"/>
  
  <div class="space-y-2">
    <x-ui.badge href="#" small>Blockchain</x-ui.badge>
    <h3 class="font-bold line-clamp-2 text-gray-900 hover:text-blue-600 transition-colors duration-300">{{ $post->title }}</h3>
    <span class="text-gray-600">17.2K views</span>
  </div>
</div>