@props(['user' => null, 'size' => 'w-10 h-10'])

@if($user)
  @php
    $avatar = $user->profile_pic 
        ? asset('storage/' . $user->profile_pic)
        : "https://ui-avatars.com/api/?name=" . urlencode($user->name) . "&background=37474f&color=fff";
  @endphp

  <div class="{{ $size }} rounded-full overflow-hidden bg-gray-300 flex items-center justify-center shrink-0">
    <img 
      src="{{ $avatar }}" 
      alt="{{ $user->name }}"
      class="w-full h-full object-cover"
    >

    <div class="w-full h-full flex items-center justify-center text-white font-bold text-sm uppercase bg-gradient-to-br from-blue-500 to-purple-600" 
        style="display: none;">
        {{ substr($user->name, 0, 2) }}
    </div>
  </div>
@endif
