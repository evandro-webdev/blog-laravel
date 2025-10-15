<x-layout class="dark:bg-slate-900">
  <x-section>
    <div class="grid md:grid-cols-3 gap-2">
      <div class="space-y-2 md:col-span-1">
        <x-profile.public-user-info :$user :$isOwnProfile/>

        @if (!$user->is_private || $isOwnProfile)
          <x-profile.user-info :$user/>
        @endif
      </div>

      <x-ui.layout.tab-container :default-tab="$isOwnProfile ? 'data' : 'posts'" class="space-y-2 md:col-span-2">
        <x-slot:tabs>
          @if($isOwnProfile)
            <x-ui.tab value="data" x-model="tab" icon="user-data">Dados</x-ui.tab>
            <x-ui.tab value="read" x-model="tab" icon="eye">Lidos ({{ $user->readPosts->count() }})</x-ui.tab>
            <x-ui.tab value="saved" x-model="tab" icon="save">Salvos ({{ $user->savedPosts->count() }})</x-ui.tab>
            <x-ui.tab value="preferences" x-model="tab" icon="preferences">Preferências</x-ui.tab>
          @else
            <x-ui.tab value="posts" x-model="tab" icon="doc">Posts</x-ui.tab>
            <x-ui.tab value="activity" x-model="tab" icon="user">Atividade</x-ui.tab>
          @endif
        </x-slot:tabs>

        <x-slot:content>
          @if($isOwnProfile)
            <x-profile.tabs.tab-data :$user/>
            <x-profile.tabs.tab-read :$user/>
            <x-profile.tabs.tab-saved :$user/>
            <x-profile.tabs.tab-preferences :$user/>
          @else
            {{-- <x-profile.tabs.posts :$user/>
            <x-profile.tabs.activity :$user/>
            <x-profile.tabs.about :$user/> --}}
          @endif
        </x-slot:content>
      </x-ui.layout.tab-container>
    </div> 

    <x-ui.toast/>
  </x-section>
</x-layout>

<script src="{{ Vite::asset('resources/js/components/follow-button.js') }}"></script>