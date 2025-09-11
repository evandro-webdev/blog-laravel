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
    class="border border-gray-200 rounded p-2 text-gray-600 bg-white cursor-pointer"
  >
    @foreach ($options as $option)
      <option value="{{ $option }}">
        {{ Str::ucfirst($option) }}
      </option>
    @endforeach
  </select>
</div>
