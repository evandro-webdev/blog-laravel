@props([
  'src' => null,
  'alt' => 'Avatar',
  'size' => 'w-10 h-10'
])

<div class="{{ $size }} rounded-full shrink-0 bg-gray-200 overflow-hidden">
  <img src="{{ $src ?? asset('images/default-avatar.png') }}" 
    alt="Foto de perfil de {{ $alt ?? 'Usuário' }}" 
    class="w-full h-full object-cover">
</div>