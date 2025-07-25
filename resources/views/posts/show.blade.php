<x-layout>
  <section class="max-w-[960px] py-20 px-5 mx-auto">
    <div class="text-center">
      <p class="mb-1 text-sm text-gray-500">Publicado em 23 de Abril, 2025</p>
      <h1 class="text-3xl font-bold text-gray-900">{{ $post->title }}</h1>
      <p class="my-4 text-gray-800">{{ $post->excerpt }}</p>
      <div class="flex justify-center gap-2">
        @foreach ($post->tags as $tag)
          <x-ui.badge>{{ $tag->name }}</x-ui.badge>
        @endforeach
      </div>
    </div>

    <div class="mx-auto my-8 rounded-md overflow-hidden">
      <img src="{{ asset('storage/' . $post->image) }}" class="w-full object-cover" alt="">
    </div>

    <article class="max-w-[700px] mx-auto prose text-gray-900">
      {!! $post->content !!}
    </article>
  </section>

  <section class="max-w-[960px] py-20 px-5 mx-auto">
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      @foreach ($relatedPosts as $post)
        <x-blog.post.card :$post/>
      @endforeach
    </div>
  </section>
</x-layout>