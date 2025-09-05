@props(['name', 'label'])

<label 
  {{ $attributes->merge(['class' => 'mb-2 font-medium inline-block text-gray-800']) }} 
  for="{{ $name }}"
>
  {{ $label }}
</label>