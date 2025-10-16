<div
  x-show="isNotificationsOpen"
  x-cloak
  x-transition.opacity.duration.200ms
  class="max-w-[1200px] mx-auto sm:px-2 md:px-4 fixed inset-0 top-[64px] sm:top-[74px] z-50 bg-black/40 sm:bg-transparent"
>
  <div 
    x-show="isNotificationsOpen"
    @click.outside="
      if(isNotificationsOpen){
        opened = true
      };
      isNotificationsOpen=false
    "
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-y-6 opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="-translate-y-6 opacity-0"
    class="sm:w-90 max-h-90 sm:ml-auto rounded-b-xl sm:rounded-xl sm:border sm:border-gray-200 
         sm:dark:border-slate-600 bg-white dark:bg-slate-800 sm:shadow-sm overflow-auto"
  >
    <div class="p-3 border-gray-100 dark:border-slate-700 flex justify-between items-center"
    >
      <div class="text-gray-700 dark:text-white flex items-center gap-2">
        <x-ui.icons.bell/>
        <p class="font-semibold">Notificações</p>
      </div>

      <template 
        x-if="unreadCount > 0 && !opened"
      >
        <x-ui.base.badge pill small variant="blue">
          {{ $unreadCount }} novas
        </x-ui.base.badge>
      </template>
    </div>

    <div 
      x-data="infiniteNotifications()"
      x-init="init()"
      class="overflow-y-auto"
    >
      <template x-for="notification in notifications" :key="notification.id">
        <div x-html="notification.html"></div>
      </template>

      <template x-if="!loading && notifications.length === 0">
        <div class="p-4 text-sm text-gray-500 text-center">
          Nenhuma notificação
        </div>
      </template>

      <div x-ref="sentinel" x-show="hasMore" class="h-6"></div>

      <x-ui.base.spinner x-show="loading" class="mx-auto"/>
    </div>
  </div>
</div>


<script>
  function infiniteNotifications(){
    return {
      notifications: [],
      page: 1,
      loading: false,
      hasMore: true,

      init (){
        if (this._initialized) return;
        this._initialized = true;
        this.loadMore();

        const observer = new IntersectionObserver(entries => {
          if(entries[0].isIntersecting && !this.loading && this.hasMore){
            this.loadMore();
          }
        })

        observer.observe(this.$refs.sentinel);
      },

      async loadMore(){
        try {
          this.loading = true;
          const response = await fetch(`/notifications?page=${this.page}`);

          if(!response.ok){
            console.error('Erro na requisição: ', response.status);
            return;
          }

          const data = await response.json();
          const items = data.notifications ?? [];
          
          this.notifications.push(...items);
          this.page++;

          this.hasMore = data.hasMore ?? items.length > 0;
        } catch (error) {
          console.error("Erro ao carregar notificações:", error);
        } finally {
          this.loading = false;
        }
      }
    }
  }
</script>