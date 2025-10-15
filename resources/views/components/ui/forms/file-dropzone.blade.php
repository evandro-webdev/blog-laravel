@props([
  'name',
  'id' => $name,
  'image' => null
])

@php
  $borderClass = 'border-2 border-dashed border-gray-300 dark:border-slate-600 hover:border-blue-300 dark:hover:border-blue-500 transition-colors';
@endphp

<div
  x-data="{ 
    hover: false,
    preview: @js($image ? asset('storage/' . $image) : ''),
    updatePreview(event){
      const file = event.target.files[0];
      if(!file) return;
      if (this.preview) URL.revokeObjectURL(this.preview);
      this.preview = URL.createObjectURL(file);
    }
  }"
  @mouseenter="hover = true"
  @mouseleave="hover = false"
>
  <x-ui.forms.label label="Imagem de capa" name="$name"/>

  <div
    class="w-full h-72 rounded-md flex justify-center items-center bg-center overflow-hidden"
    :class="!preview ? @js($borderClass) : ''"
    :style="preview ? `background-image: url(${preview})` : ''"
  >
    <input 
      id="{{ $id }}"
      name="{{ $name }}" 
      type="file" 
      accept="image/webp, image/jpeg"
      x-ref="fileInput"
      @change="updatePreview"
      {{ $attributes->merge(['class' => 'hidden']) }}
    >
  
    <div 
      x-show="!preview || hover"
      x-transition.opacity.duration.300ms
      class="w-full h-full flex flex-col justify-center items-center"
      :class="preview ? 'backdrop-blur-md bg-black/30 dark:bg-black/40' : ''"
    >
      <x-ui.icons.download size="w-8 h-8" class="text-blue-600 dark:text-blue-500"/>
    
      <div class="my-3 text-center">
        <p 
          class="text-lg font-bold dark:text-white transition-colors duration-500" 
          :class="hover && preview ? 'text-white' : 'text-gray-800'"
        >
          Arraste sua imagem aqui
        </p>
        <p 
          class="text-sm font-medium dark:text-white transition-colors duration-500"
          :class="hover && preview ? 'text-white' : 'text-gray-600'"
        >
          JPG, WEBP de até 2MB
        </p>
      </div>
  
      <label 
        for="{{ $id }}" 
        class="py-2 px-3 cursor-pointer rounded-md border font-medium text-blue-600 border-gray-200 
              bg-white hover:bg-gray-100 dark:hover:bg-gray-200 transition-colors"
        x-text="preview ? 'Alterar imagem' : 'Selecionar imagem'"
      ></label>
    </div>
  
    <x-ui.forms.error class="mt-2" :error="$errors->first($name)"/>
  </div>
</div>
