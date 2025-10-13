<button 
  type="button" 
  id="menu-button"
  @click="isMenuOpen=!isMenuOpen"
  class="relative p-2 cursor-pointer rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-colors md:hidden" 
>
  <template x-if="!isMenuOpen">
    <x-ui.icons.menu size="w-6 h-6"/>
  </template>
  
  <template x-if="isMenuOpen">
    <x-ui.icons.close size="w-6 h-6"/>
  </template>
</button>