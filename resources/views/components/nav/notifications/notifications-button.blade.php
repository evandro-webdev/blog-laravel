@props([
  'unreadCount'
])

<button
  @click="
    if(isNotificationsOpen){
      opened = true
    };
    isNotificationsOpen = !isNotificationsOpen;
    isMenuOpen = false;
    if({{ $unreadCount }} > 0) {
      const oldCount = this.unreadCount;
      this.unreadCount = 0;

      fetch('/notifications/read', {
        method: 'POST', 
        headers: { 
          'X-CSRF-TOKEN': '{{ csrf_token() }}', 
          'Accept': 'application/json'
        } 
      }).catch(() => {
        this.unreadCount = this.oldCount;
      });
    }
  "
  x-cloak
  class="p-2 rounded-full cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900 transition-colors"
>
  <x-ui.icons.bell size="w-6 h-6" class="text-blue-600 dark:text-blue-400"/>
  <template x-if="unreadCount > 0 && !opened">
    <span x-show="!isNotificationsOpen" class="absolute top-3 w-4 h-4 rounded-full text-xs font-bold text-white bg-blue-600">
      {{ $unreadCount }}
    </span>
  </template>
</button>