<div
  x-data="{ 
    isOpen: false,
    title: '',
    content: '',
    callback: null,
    open(event){
      this.title = event.detail.title
      this.content = event.detail.content
      this.isOpen = true
      this.callback = event.detail?.onConfirm || null
    },
    close(){
      this.isOpen = false
      this.callback = null
    },
    confirm(){
      if(this.callback) this.callback()
      this.close()
    }
  }"
  x-show="isOpen"
  @open-modal.window="open($event)"
  x-transition.opacity.duration.300ms
  class="fixed w-full h-full p-4 bg-black/10 dark:bg-black/40 flex justify-center items-center z-100"
>
  <div @click.outside="close()" class="w-md p-6 space-y-6 rounded-xl bg-white dark:bg-slate-800">
    <div class="space-y-2">
      <h3 x-text="title" class="text-xl font-semibold text-gray-700 dark:text-white"></h3>
      <p x-text="content" class="text-gray-600 dark:text-gray-100"></p>
    </div>

    <div class="flex justify-end gap-2">
      <x-ui.forms.button 
        @click="close()" 
        size="sm" 
        variant="neutral" 
        outline
      >
        Cancelar
      </x-ui.forms.button>

      <x-ui.forms.button
        @click="confirm()"
        size="sm"
      >
        Confirmar
      </x-ui.forms.button>
    </div>
  </div>
</div>