@props([
  'title',
  'subtitle'
])

<div {{ $attributes->merge(['class' => 'space-y-1']) }}>
  <h1 class="text-2xl font-black text-gray-800 dark:text-white md:text-3xl lg:text-4xl">{{ $title }}</h1>
  <p class="text-gray-600 dark:text-gray-100">{{ $subtitle }}</p>
</div>