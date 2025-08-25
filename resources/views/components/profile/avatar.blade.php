@props([
    'src' => null,
    'alt' => 'Usuário',
    'size' => 'w-10 h-10'
])

<div class="{{ $size }} rounded-full shrink-0 bg-gray-200 flex items-center justify-center text-gray-700 font-bold overflow-hidden">
    @if($src)
        <img 
            src="{{ $src }}" 
            alt="Foto de perfil de {{ $alt }}" 
            class="w-full h-full object-cover"
        >
    @else
        {{ strtoupper(substr($alt, 0, 1)) }}
    @endif
</div>
