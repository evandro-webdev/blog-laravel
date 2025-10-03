<div 
  class="fixed left-4 top-1/2 -translate-y-1/2 z-40 hidden lg:flex flex-col gap-3"
  x-data="{ showActions: false }"
  x-init="
    window.addEventListener('scroll', () => {
      showActions = window.pageYOffset > 400;
    })
  "
  x-show="showActions"
  x-transition
>
  <button 
    @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
    class="p-3 rounded-full bg-white dark:bg-gray-700 shadow-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
  >
    <x-ui.icons.arrow-up class="text-gray-600 dark:text-white"/>
  </button>

  <div class="relative" x-data="{ open: false }">
    <button 
      @click="open = !open"
      class="p-3 rounded-full bg-white dark:bg-gray-700 shadow-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
    >
      <x-ui.icons.font-size class="text-gray-600 dark:text-white"/>
    </button>
      
    <div 
      x-show="open" @click.away="open = false" 
      x-transition
      class="ml-2 rounded-lg text-gray-600 dark:text-white absolute left-full top-0 bg-white dark:bg-gray-700 shadow-lg p-2 whitespace-nowrap"
    >
      <div class="space-y-1">
        <button 
          @click="document.documentElement.style.fontSize = '14px'; open = false"
          class="block px-3 py-1 rounded text-sm hover:bg-gray-100 dark:hover:bg-gray-800"
        >
          Pequeno
        </button>
        <button 
          @click="document.documentElement.style.fontSize = '16px'; open = false"
          class="block px-3 py-1 rounded text-sm hover:bg-gray-100 dark:hover:bg-gray-800"
        >
          Normal
        </button>
        <button 
          @click="document.documentElement.style.fontSize = '18px'; 
          open = false"
          class="block px-3 py-1 rounded text-sm hover:bg-gray-100 dark:hover:bg-gray-800"
        >
          Grande
        </button>       
      </div>
    </div>
  </div>
</div>