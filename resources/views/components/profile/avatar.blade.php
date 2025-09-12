@props([
  'user',
  'size' => 'w-10 h-10'
])

<div class="{{ $size }} rounded-full shrink-0 font-bold text-white overflow-hidden flex items-center justify-center bg-blue-500">
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
