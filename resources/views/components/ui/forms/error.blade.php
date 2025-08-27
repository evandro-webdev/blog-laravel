@props(['error' => false])

@if ($error)
  <p {{ $attributes->merge(['class' => 'text-xs font-medium text-red-500 mt-1']) }}>{{ $error }}</p>
@endif

@if (!$error && $attributes->has('x-show'))
  <p {{ $attributes->merge(['class' => 'text-xs font-medium text-red-500 mt-1']) }}></p>
@endif