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
  <x-profile.avatar :user="$notification->actor" />

  <div class="flex flex-col gap-1">
    <a href="#" class="text-sm line-clamp-2 text-gray-700 dark:text-white">
      {{ $notification->data['message'] }}
    </a>
    <x-ui.utilities.datetime :date="$notification->created_at" class="text-xs text-gray-600 dark:text-gray-100"/>
  </div>
</div>
