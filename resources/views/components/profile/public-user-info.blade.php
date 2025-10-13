@props([
  'user',
  'isOwnProfile'
])

<x-ui.base.panel>
  <div class="space-y-6 flex flex-col items-center">
    <div>
      <div class="w-fit mx-auto relative">
        <x-profile.avatar :user="$isOwnProfile ? Auth::user() : $user" size="w-30 h-30"/>

        @if ($isOwnProfile)
          <x-profile.avatar-upload :$user/>
        @endif
      </div>

      <x-ui.forms.error :error="$errors->first('profile_pic')" class="[text-wrap:balance] mt-4 text-center"/>
    </div>

    <div class="space-y-1 text-center">
      <h3 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $user->name }}</h3>
      <x-ui.base.badge small variant="white">{{ '@' . $user->username }}</x-ui.badge>
    </div>

    <x-ui.interactive.follow-button :$user/>

    <x-profile.user-statistics :$user/>

    @if($user->is_private && !$isOwnProfile)
      <x-ui.utilities.message class="text-sm" message="Este perfil é privado. Siga para ver mais."/>
    @endif
  </div>
</x-ui.base.panel>