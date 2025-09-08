<div class="p-3 flex gap-2 transition-colors hover:bg-gray-50 border-l-4 
  {{ is_null($notification->read_at) ? 'border-blue-500 bg-blue-50' : 'border-transparent' }}"
>
  <x-profile.avatar :user="$notification->actor" />

  <div class="flex flex-col gap-1">
    <a href="#" class="text-sm font-medium text-gray-800">
      {{ $notification->data['message'] }}
    </a>
    <time class="text-xs text-gray-600" datetime="{{ $notification->created_at }}">
      {{ $notification->created_at->diffForHumans() }}
    </time>
  </div>
</div>
