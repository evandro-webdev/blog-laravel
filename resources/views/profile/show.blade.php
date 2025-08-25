<x-layout>
  <x-section>
    <x-page-heading 
      :title="$isOwnProfile ? 'Meu perfil' : $user->name" 
      :subtitle="$isOwnProfile ? 'Confira ou atualize as informações da sua conta' : 'Perfil público de ' . $user->name"
    />

    <div class="grid gap-2">
      <x-ui.panel>
        <div class="flex flex-col items-center">
          <x-profile.avatar 
            :src="Auth::user()->profile_pic"
            :alt="Auth::user()->name"
            size="w-24 h-24"
          />
          <h3 class="my-3 font-bold text-gray-800">{{ $user->name }}</h3>
  
          <div class="w-full flex justify-around">
            <div class="text-center">
              <span class="text-xl font-bold text-blue-600">{{ $stats['posts_read'] ?? 22 }}</span>
              <p class="text-sm text-gray-500">Posts lidos</p>
            </div>
            <div class="text-center">
              <span class="text-xl font-bold text-blue-600">{{ $stats['posts_saved'] ?? 22 }}</span>
              <p class="text-sm text-gray-500">Posts salvos</p>
            </div>
          </div>

          <x-ui.follow-button :$user/>
        </div>
      </x-ui.panel>

      <x-ui.panel>
        <h3 class="mb-6 font-bold text-gray-800">Estatísticas de leitura</h3>
        <div class="space-y-2">
          <x-ui.icon-item icon="users-gray" label="Seguindo" value="{{ $user->following_count }}"/>
          <x-ui.icon-item icon="user-gray" label="Seguidores" value="{{ $user->followers_count }}" data-followers-count/>
          <x-ui.icon-item icon="comment-gray" label="Comentários" value="{{ $user->comments_count }}"/>
          <x-ui.icon-item icon="star-gray" label="Membro desde" value="{{ $user->created_at->year }}"/>
        </div>
      </x-ui.panel>

      <x-ui.tab-container :default-tab="$isOwnProfile ? 'data' : 'posts'">
        <x-slot:tabs>
          @if($isOwnProfile)
            <x-ui.tab value="data" x-model="tab">Dados</x-ui.tab>
            <x-ui.tab value="read" x-model="tab">Lidos</x-ui.tab>
            <x-ui.tab value="saved" x-model="tab">Salvos</x-ui.tab>
            <x-ui.tab value="notifications" x-model="tab">Notificações</x-ui.tab>
          @else
            <x-ui.tab value="posts" x-model="tab">Posts</x-ui.tab>
            <x-ui.tab value="activity" x-model="tab">Atividade</x-ui.tab>
            <x-ui.tab value="about" x-model="tab">Sobre</x-ui.tab>
          @endif
        </x-slot:tabs>

        <x-slot:content>
          @if($isOwnProfile)
            {{-- <x-profile.tabs.data :$user/>
            <x-profile.tabs.read :$user/>
            <x-profile.tabs.saved :$user/>
            <x-profile.tabs.notifications :$user/> --}}
          @else
            {{-- <x-profile.tabs.posts :$user/>
            <x-profile.tabs.activity :$user/>
            <x-profile.tabs.about :$user/> --}}
          @endif
        </x-slot:content>
      </x-ui.tab-container>
    </div> 
  </x-section>
</x-layout>

<script src="{{ Vite::asset('resources/js/components/follow-button.js') }}"></script>