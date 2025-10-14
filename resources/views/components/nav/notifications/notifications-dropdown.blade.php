<div
  x-show="isNotificationsOpen"
  x-cloak
  x-transition.opacity.duration.200ms
  class="max-w-[1200px] mx-auto sm:px-2 md:px-4 fixed inset-0 top-[64px] sm:top-[74px] z-50 bg-black/40 sm:bg-transparent"
>
  <div 
    x-show="isNotificationsOpen" 
    @click.outside="isNotificationsOpen=false"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-y-6 opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="-translate-y-6 opacity-0"
    class="sm:w-90 sm:ml-auto rounded-b-xl sm:rounded-xl sm:border sm:border-gray-200 sm:dark:border-slate-800 bg-white dark:bg-slate-900 sm:shadow-sm"
  >
    <div class="p-3 border-b border-gray-100 dark:border-slate-800 font-medium 
              text-gray-800 dark:text-white flex justify-between items-center"
    >
      <p>Notificações</p>
      <template x-if="unreadCount > 0">
        <x-ui.base.badge pill small>
          {{ $unreadCount }} novas
        </x-ui.base.badge>
      </template>
    </div>

    <div class="overflow-y-auto">
      @forelse (Auth::user()->notifications as $notification)
        <x-nav.notifications.notification-item :$notification/>
      @empty
        <div class="p-4 text-sm text-gray-500 text-center">
          Nenhuma notificação
        </div>
      @endforelse
    </div>
  </div>
</div>