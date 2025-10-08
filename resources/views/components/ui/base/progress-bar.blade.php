<div 
  class="fixed top-0 left-0 h-1 bg-blue-600 z-50 transition-all duration-300" 
  x-data="{ width: '0%' }"
  x-init="
    window.addEventListener('scroll', () => {
      const scrollTop = window.pageYOffset;
      const docHeight = document.body.offsetHeight - window.innerHeight;
      const scrollPercent = (scrollTop / docHeight) * 100;
      width = Math.min(scrollPercent, 100) + '%';
    })
  "
  :style="`width: ${width}`"
>
</div>