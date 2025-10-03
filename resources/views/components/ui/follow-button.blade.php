@auth
  @unless (Auth::id() === $user->id)   
    <div 
      x-data="followButton({{ $user->id }}, {{ Auth::user()->isFollowing($user->id) ? 'true' : 'false' }}, '{{ csrf_token() }}')"
    >
      <button
        @click="toggleFollow" 
        :disabled="loading"
        class="px-4 py-2 rounded-lg text-sm font-medium cursor-pointer flex items-center gap-2 transition-colors duration-200"
        :class="isFollowing
          ? 'text-white bg-blue-600 hover:bg-blue-700' 
          : 'text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600'"
      >
        <x-ui.spinner x-show="loading"/>
        <x-ui.icons.user x-show="!loading" size="w-4 h-4" stroke="2"/>
        <span x-text="isFollowing ? 'Seguindo' : 'Seguir'" class="text-sm font-medium"></span>
      </button>
    </div>
  @endunless
@endauth