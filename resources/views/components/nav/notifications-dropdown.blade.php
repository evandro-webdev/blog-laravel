@php
  $unreadCount = Auth::user()->unreadNotifications()->count();
@endphp

<div x-data="{ 
    notificationsOpen: false,
    unreadCount: {{ $unreadCount }},
    markAsRead(){
      if(this.unreadCount > 0){
        const oldCount = this.unreadCount;
        this.unreadCount = 0;

        fetch('/notifications/read', {
          method: 'POST', 
          headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 
          'Accept': 'application/json' } 
        }).catch(() => {
          this.unreadCount = this.oldcount;
        });
      }
    }
  }" 
  class="relative z-50"
>
  <button 
    @click="notificationsOpen = !notificationsOpen; if({{ $unreadCount }} > 0) markAsRead()"" 
    @click.away="notificationsOpen = false"
    x-cloak
    class="p-2 rounded-full cursor-pointer hover:bg-blue-50 transition-colors relative 
            focus:ring-1 focus:ring-white focus:ring-offset-1 focus:ring-offset-blue-600 focus:bg-blue-50 focus:outline-none"
  >
    <template x-if="unreadCount > 0">
      <span x-show="!notificationsOpen" class="w-4 h-4 rounded-full text-xs font-bold text-white bg-blue-600 absolute top-1">
        {{ $unreadCount }}
      </span>
    </template>
    <x-ui.icons.bell class="w-6 h-6 text-blue-600"/>
  </button>

  <div 
    x-show="notificationsOpen" 
    x-transition
    class="w-80 rounded-md absolute top-16 right-0 bg-white shadow-md overflow-hidden"
  >
    <div class="py-2 px-3 border-b border-gray-100 text-sm font-medium text-gray-800 flex justify-between items-center">
      <p>Notificações</p>
      <template x-if="unreadCount > 0">
        <x-ui.badge pill small>
          {{ $unreadCount }} novas
        </x-ui.badge>
      </template>
    </div>

    <div class="max-h-80 overflow-y-auto">
      @forelse (Auth::user()->notifications as $notification)
        <x-nav.notification-item :$notification/>
      @empty
        <div class="p-4 text-sm text-gray-500 text-center">
          Nenhuma notificação
        </div>
      @endforelse
    </div>
  </div>
</div>