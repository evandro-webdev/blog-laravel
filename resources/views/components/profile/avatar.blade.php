@props([
  'user' => null,
  'size' => 'w-10 h-10'
])

<div class="{{ $size }} rounded-full shrink-0 bg-gray-200 flex items-center justify-center text-gray-700 font-bold overflow-hidden">
  @if($user->profile_pic)
    <img 
      src="{{ $user->profile_pic }}" 
      alt="Foto de perfil de {{ $user->name }}" 
      class="w-full h-full object-cover"
    >
  @else
    {{ strtoupper(substr($user->name, 0, 1)) }}
  @endif
</div>
