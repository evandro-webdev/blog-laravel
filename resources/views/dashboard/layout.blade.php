<x-layout>
  <div class="flex bg-gray-50 dark:bg-gray-900">
    <x-dashboard.sidebar/>

    <div class="min-w-0 w-full py-6 px-4 lg:px-10 space-y-6">
      @yield('content')
    </div>
  </div>
</x-layout>