@props([
  'notification',
  'opened'
])

@php
  $borderClasses = is_null($notification->read_at) ? 'border-blue-500 bg-blue-50 dark:bg-slate-600' : 'border-transparent';
@endphp

<div 
  class="px-3 py-4 flex gap-2 border-l-4 {{ $borderClasses }} hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors"
>
  @if ($notification->actor)
    <x-profile.avatar :user="$notification->actor" />

    <div class="flex flex-col gap-1">
      <a href="#" class="text-sm line-clamp-2 text-gray-700 dark:text-white">
        {{ $notification->data['message'] }}
      </a>
      <x-ui.utilities.datetime :date="$notification->updated_at" class="text-xs text-gray-600 dark:text-gray-100"/>
    </div>
  @else
    <img 
      src="{{ asset('storage/profile_pics/avatar-placeholder.webp') }}" 
      class="w-10 h-10 rounded-full border-0 overflow-hidden dark:bg-slate-700 flex items-center justify-center shrink-0">

    <div class="flex flex-col gap-1">
      <a href="#" class="text-sm line-clamp-2 text-gray-700 dark:text-white">
        Usuário deletado
      </a>
      <x-ui.utilities.datetime :date="$notification->updated_at" class="text-xs text-gray-600 dark:text-gray-100"/>
    </div>
  @endif
</div>
