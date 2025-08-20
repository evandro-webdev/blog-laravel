@auth
  @unless (Auth::id() === $user->id)   
    <div 
      x-data="followButton({{ $user->id }}, {{ Auth::user()->isFollowing($user->id) ? 'true' : 'false' }}, '{{ csrf_token() }}')"
    >
      <button 
        @click="toggleFollow" 
        class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 transition flex items-center justify-center gap-2"
        :disabled="loading"
      >
        <svg 
          x-show="loading" 
          class="animate-spin h-4 w-4 text-white" 
          fill="none" 
          viewBox="0 0 24 24"
        >
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>

        <span x-text="isFollowing ? 'Deixar de seguir' : 'Seguir'"></span>
      </button>
    </div>
  @endunless
@endauth