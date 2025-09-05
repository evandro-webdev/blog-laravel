@props([
  'label',
  'checked' => false,
  'name'
])

<div x-data="{ on: {{ $checked ? 'true' : 'false' }}}" class="flex items-center justify-between py-3">
  <span class="text-lg text-gray-700">{{ $label }}</span>

  <input type="hidden" name="{{ $name }}" value="0">

  <button
    type="button"
    @click="on = !on; $refs.input.checked = on"
    :class="on ? 'bg-blue-600' : 'bg-gray-300'"
    class="relative inline-flex h-6 w-11 items-center rounded-full cursor-pointer transition-colors duration-200 focus:outline-none"
  >
    <span
      :class="on ? 'translate-x-6' : 'translate-x-1'"
      class="inline-block w-4 h-4 transform rounded-full bg-white transition-transform duration-200"
    ></span>
  </button>

  <input x-ref="input" type="checkbox" name="{{ $name }}" value="1" class="hidden" :checked="on">
</div>