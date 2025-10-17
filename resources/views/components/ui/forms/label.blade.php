@props([
  'id',
  'label'
])

<label 
  {{ $attributes->merge(['class' => 'mb-2 font-medium inline-block text-gray-800 dark:text-white']) }} 
  for="{{ $id }}"
>
  {{ $label }}
</label>