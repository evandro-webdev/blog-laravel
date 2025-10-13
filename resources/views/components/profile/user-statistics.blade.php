@props([
  'user'
])

<div class="max-w-sm w-full flex flex-wrap justify-center gap-4">
  <div class="text-center">
    <span class="text-xl font-bold text-blue-600 dark:text-blue-500">{{ $user->getFollowersCount() }}</span>
    <p class="text-sm text-gray-500 dark:text-gray-100">Seguidores</p>
  </div>
  <div class="text-center">
    <span class="text-xl font-bold text-blue-600 dark:text-blue-500">{{ $user->getFollowingCount() }}</span>
    <p class="text-sm text-gray-500 dark:text-gray-100">Seguindo</p>
  </div>
  <div class="text-center">
    <span class="text-xl font-bold text-blue-600 dark:text-blue-500">{{ $user->posts()->count() }}</span>
    <p class="text-sm text-gray-500 dark:text-gray-100">Publicações</p>
  </div>
</div>