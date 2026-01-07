<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>
    (function () {
      const theme = localStorage.getItem('theme')

      if (
        theme === 'dark' ||
        (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)
      ) {
        document.documentElement.classList.add('dark')
      }
    })()
  </script>

  <style>
    html { background-color: #ffffff; }
    html.dark { background-color: #0f172a; }
  </style>

  @vite(['resources/js/app.js'])
  @stack('scripts')
  <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Blog Tecnologia</title>
</head>
<body class="min-h-screen flex flex-col">
  <x-nav/>

  <main {{ $attributes->merge(['class' => 'flex-1 flex flex-col transition-colors']) }}>
    {{ $slot }}
  </main>

  <x-ui.interactive.confirmation-modal/>

  <x-footer/>
</body>
</html>
