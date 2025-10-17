@props([
  'user'
])

@auth
  @unless (Auth::id() === $user->id)   
    <div 
      x-data="actionButton(
        '{{ '/user/' . $user->id . '/follow' }}',
        {{ Auth::user()->isFollowing($user->id) ? 'true' : 'false' }},
        '{{ csrf_token() }}'
      )"
    >
      <button
        @click="toggleActive" 
        :disabled="loading"
        class="px-4 py-2 rounded-lg text-sm font-medium cursor-pointer flex items-center gap-2 transition-colors duration-200"
        :class="isActive
          ? 'text-white bg-blue-600 hover:bg-blue-700' 
          : 'text-gray-700 dark:text-white bg-gray-100 dark:bg-slate-600 hover:bg-gray-200 dark:hover:bg-slate-500'"
      >
        <template x-if="!loading">
          <x-ui.icons.user x-show="!loading" size="w-4 h-4" stroke="2"/>
        </template>

        <x-ui.base.spinner x-show="loading"/>

        <span x-text="isActive ? 'Seguindo' : 'Seguir'" class="text-sm font-medium"></span>
      </button>
    </div>
  @endunless
@endauth