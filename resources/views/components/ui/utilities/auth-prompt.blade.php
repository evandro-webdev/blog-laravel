@props([
  'message' => 'Faça login para continuar'
])

<x-ui.base.panel class="text-center flex flex-col items-center gap-4">
  <p class="text-gray-600 dark:text-white">{{ $message }}</p>
  <x-ui.forms.button href="{{ route('login') }}" icon="enter" size="sm">Entrar</x-ui.forms.button>
  <p class="text-sm text-gray-500 dark:text-gray-100">
    Ainda não tem conta?
    <a href="{{ route('register') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Cadastre-se</a>
  </p>
</x-ui.base.panel>