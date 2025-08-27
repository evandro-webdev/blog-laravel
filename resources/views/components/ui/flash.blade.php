@props(['message' => null])

@if ($message)
  <script>
    window.addEventListener('DOMContentLoaded', () => {
      window.dispatchEvent(new CustomEvent('notify', {
        detail: @json($message)
      }));
    });
  </script>
@endif