@props(['error' => false])

{{-- Para erros do Laravel (server-side) --}}
@if ($error)
  <p {{ $attributes->merge(['class' => 'text-xs font-medium text-red-500 mt-1']) }}>{{ $error }}</p>
@endif

{{-- Para erros do Alpine (client-side) - quando não há erro do Laravel --}}
@if (!$error && $attributes->has('x-show'))
  <p {{ $attributes->merge(['class' => 'text-xs font-medium text-red-500 mt-1']) }}></p>
@endif