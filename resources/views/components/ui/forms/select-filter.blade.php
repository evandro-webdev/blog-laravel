@props([
  'options' => [],
  'sort' => null,
])

<div x-data="{
    value: '{{ $sort }}',
    update() {
      const url = new URL(window.location.href);
      url.searchParams.set('sort', this.value);
      window.location.href = url.toString();
    }
}">
  <select
    x-model="value"
    @change="update"
    class="p-2 rounded border border-gray-200 dark:border-gray-700  text-gray-600 dark:text-gray-200 bg-transparent cursor-pointer"
  >
    @foreach ($options as $option)
      <option value="{{ $option }}">
        {{ Str::ucfirst($option) }}
      </option>
    @endforeach
  </select>
</div>
