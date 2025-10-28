<x-layout>
  <div class="flex min-h-screen bg-gray-50 dark:bg-gray-900">
    <x-dashboard.sidebar/>

    <div class="w-full p-10 space-y-6">
      @yield('content')
    </div>
  </div>
</x-layout>