@props(['user' => null, 'size' => 'w-10 h-10'])

@if($user)
  @php
    $avatar = $user->profile_pic 
        ? asset('storage/' . $user->profile_pic)
        : "https://ui-avatars.com/api/?name=" . urlencode($user->name) . "&background=0f172a&color=fff";
  @endphp

  <div 
    class="{{ $size }} rounded-full border-0 overflow-hidden dark:bg-slate-700
          flex items-center justify-center shrink-0"
  >
    <img 
      src="{{ $avatar }}" 
      alt="{{ $user->name }}"
      class="w-full h-full object-cover block select-none pointer-events-none"
    >

    <div 
      class="absolute inset-0 font-bold text-sm uppercase text-white dark:bg-slate-700 hidden"
    >
      {{ substr($user->name, 0, 2) }}
    </div>
  </div>
@endif

