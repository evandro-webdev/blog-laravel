<button 
  x-data="{ 
    dark: localStorage.getItem('theme') === 'dark',
    toggleTheme(){
      this.dark = !this.dark

      if (this.dark) {
        document.documentElement.classList.add('dark')
        localStorage.setItem('theme', 'dark')
      } else {
        document.documentElement.classList.remove('dark')
        localStorage.setItem('theme', 'light')
      }

      // Se TinyMCE existir na página, reinicia com o tema certo
      if (typeof tinymce !== 'undefined') {
        initTinymce(this.dark)
      }
    }
  }" 
  class="w-6 h-6 rounded-full cursor-pointer relative"
  @click="toggleTheme()"
>
  <x-ui.icons.sun 
    class="absolute inset-0 w-6 h-6 text-blue-600"
    x-show="!dark"
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-75 rotate-90"
    x-transition:enter-end="opacity-100 scale-100 rotate-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100 rotate-0"
    x-transition:leave-end="opacity-0 scale-75 rotate-90"
  />

  <x-ui.icons.moon 
    class="absolute inset-0 w-6 h-6 text-blue-400"
    x-show="dark"
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-75 -rotate-90"
    x-transition:enter-end="opacity-100 scale-100 rotate-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100 rotate-0"
    x-transition:leave-end="opacity-0 scale-75 -rotate-90"
  />
</button>