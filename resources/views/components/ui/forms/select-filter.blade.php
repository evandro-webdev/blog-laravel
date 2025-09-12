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
    class="border border-gray-200 dark:border-gray-700 rounded p-2 text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-900 cursor-pointer"
  >
    @foreach ($options as $option)
      <option value="{{ $option }}">
        {{ Str::ucfirst($option) }}
      </option>
    @endforeach
  </select>
</div>
