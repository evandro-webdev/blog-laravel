<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog Tecnologia</title>
  @vite(['resources/js/app.js'])
  <script src="https://cdn.tiny.cloud/1/3qqrdxghokajgnwrpufmupg41lyo1e5llr6bymftc3btdx6v/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
  <x-nav/>

  <main class="min-h-screen">
    {{ $slot }}
  </main>

  <x-footer/>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.querySelector('#menu-button');
    const mobileMenu = document.querySelector('#mobile-menu');
    const openIcon = menuButton.querySelector('#open-icon');
    const closeIcon = menuButton.querySelector('#close-icon');

    function toggleMenu() {
      mobileMenu.classList.toggle('hidden');
      
      openIcon.classList.toggle('hidden');
      closeIcon.classList.toggle('hidden');
      
      const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';
      menuButton.setAttribute('aria-expanded', !isExpanded);
    }

      menuButton.addEventListener('click', toggleMenu);
    });
    </script>


</body>
</html>
