<div 
  class="p-3 flex gap-2 transition-colors hover:bg-gray-50 dark:hover:bg-gray-900 border-l-4 
  {{ is_null($notification->read_at) ? 'border-blue-500 bg-blue-50 dark:bg-gray-700' : 'border-transparent' }}"
>
  <x-profile.avatar :user="$notification->actor" />

  <div class="flex flex-col gap-1">
    <a href="#" class="text-sm font-medium line-clamp-2 text-gray-800 dark:text-white">
      {{ $notification->data['message'] }}
    </a>
    <x-ui.datetime :date="$notification->created_at" class="text-xs text-gray-600 dark:text-gray-100"/>
  </div>
</div>
