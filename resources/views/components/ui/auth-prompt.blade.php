@props([
  'message' => 'Faça login para continuar'
])

<div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm text-center">
  <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $message }}</p>
  <div class="flex gap-2 items-center justify-center">
    <x-ui.forms.button href="{{ route('login') }}" size="sm">Fazer login</x-ui.forms.button>
    <span class="text-gray-600 dark:text-gray-300">ou</span>
    <x-ui.forms.button href="{{ route('register') }}" size="sm">Criar conta</x-ui.forms.button>
  </div>
</div>