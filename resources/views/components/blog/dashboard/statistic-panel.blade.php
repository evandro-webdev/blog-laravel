@props([
  'icon',
  'label',
  'statistic'
])

<x-ui.base.panel class="space-y-4 hover:bg-gray-50 dark:hover:bg-slate-600">
  <div class="flex justify-between">
    <span class="font-medium text-gray-900 dark:text-white">{{ $label }}</span>
    <x-dynamic-component :component="'ui.icons.' . $icon" class="text-blue-600 dark:text-blue-500"/>
  </div>
  <div>
    <span class="text-3xl font-bold text-gray-800 dark:text-white">{{ $statistic['total'] }}</span>
    <p class="text-sm text-gray-700 dark:text-gray-300">+{{ $statistic['last_30_days'] }} no ultimo mês</p>
  </div>
</x-ui.base.panel>