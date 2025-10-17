@props([
  'label',
  'name',
  'id' => $name,
  'checked' => false,
  'tip' => null
])

<x-ui.forms.field 
  :$name
  :label="false"
  :$tip
>
  <div
    x-data="{ checked: {{ old($name, $checked) ? 'true' : 'false' }} }" 
    class="flex items-center gap-2"
  >
    <input
      type="checkbox"
      hidden
      id="{{ $id }}"
      name="{{ $name }}"
      x-model="checked"
      {{ $attributes->merge(['class']) }}
    >

    <label for="{{ $id }}" class="cursor-pointer text-gray-600 dark:text-gray-300">
      <template x-if="!checked">
        <x-ui.icons.square/> 
      </template>
  
      <template x-if="checked">
        <x-ui.icons.checked-square/> 
      </template>
    </label>

    <x-ui.forms.label :$label :$id class="mb-0!"/>
  </div>
</x-ui.forms.field>