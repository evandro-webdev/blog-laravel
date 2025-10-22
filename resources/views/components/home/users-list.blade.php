@props([
  'users',
  'follow' => false
])

<div class="space-y-1.5">
  @foreach ($users as $user)
    <div class="flex items-center justify-between p-2 rounded-md hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors group">
      <a href="{{ route('profile.show', $user) }}" class="flex items-center gap-2">
        <x-profile.avatar :user="$user" size="w-10 h-10"/>
        <div>
          <span class="block text-sm font-medium text-gray-800 dark:text-white">
            {{ $user->name }}
          </span>
          <span class="block text-xs text-gray-500 dark:text-gray-400">
            {{ $user->posts->count() }} posts
          </span>
        </div>
      </a>
      @if ($follow)
        <x-ui.interactive.follow-button :user="$user"/>
      @endif
    </div>
  @endforeach
</div>