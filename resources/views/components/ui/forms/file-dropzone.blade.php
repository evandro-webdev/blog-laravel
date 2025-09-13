@props([
  'name',
  'id' => $name,
  'label' => 'Selecionar imagem',
  'icon' => asset('images/icons/download-outline.svg'),
  'placeholder' => 'Arraste sua imagem aqui',
])

<div class="p-10 rounded-md border-2 border-dashed border-gray-300 dark:border-gray-700 hover:border-blue-300 dark:hover:border-blue-900 transition-colors flex flex-col items-center">
  <x-ui.icons.download size="w-8 h-8" class="text-blue-600 dark:text-blue-400"/>
  
  <div class="my-3 text-center">
    <p class="font-bold text-gray-900 dark:text-white">{{ $placeholder }}</p>
    <p class="text-xs text-gray-600 dark:text-gray-100">JPG, WEBP de até 2MB</p>
  </div>

  <label 
    for="{{ $id }}" 
    class="py-2 px-4 rounded-md border border-gray-300 dark:border-gray-700 font-medium text-blue-600 dark:text-blue-400 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
  >
    {{ $label }}
  </label>

  <input 
    type="file" 
    name="{{ $name }}" 
    id="{{ $id }}" 
    {{ $attributes->merge(['class' => 'hidden']) }}
  >

  <x-ui.forms.error class="mt-2" :error="$errors->first($name)"/>
</div>
