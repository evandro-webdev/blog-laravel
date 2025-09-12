<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @vite(['resources/js/app.js'])
  @stack('scripts')
  <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <title>Blog Tecnologia</title>
</head>
<body class="min-h-screen flex flex-col">
  <x-nav/>

  <main {{ $attributes->merge(['class' => 'flex-1 flex flex-col']) }}>
    {{ $slot }}
  </main>

  <x-footer/>
</body>
</html>
