@auth
  @unless (Auth::id() === $user->id)   
    <div 
      x-data="followButton({{ $user->id }}, {{ Auth::user()->isFollowing($user->id) ? 'true' : 'false' }}, '{{ csrf_token() }}')"
    >
      <button 
        @click="toggleFollow" 
        class="px-3 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 transition flex items-center justify-center gap-2"
        :disabled="loading"
      >
        <x-ui.spinner x-show="loading"/>

        <span x-text="isFollowing ? 'Deixar de seguir' : 'Seguir'" class="text-sm font-medium"></span>
      </button>
    </div>
  @endunless
@endauth