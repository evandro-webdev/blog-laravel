@props([
  'user',
  'size' => 'w-10 h-10'
])

<div class="{{ $size }} rounded-full border-1 border-blue-400 shrink-0 bg-blue-50 flex items-center justify-center text-blue-400 font-bold overflow-hidden">
  @if(!empty($user->profile_pic))
    <img 
      src="{{ asset('storage/' . $user->profile_pic) }}" 
      alt="Foto de perfil de {{ $user->name }}" 
      class="w-full h-full object-cover"
    >
  @else
    {{ strtoupper(substr($user->name, 0, 1)) }}
  @endif
</div>
