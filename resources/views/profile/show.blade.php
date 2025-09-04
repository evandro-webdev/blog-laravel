<x-layout>
  <x-section>
    <div class="grid md:grid-cols-3 gap-2">
      <div class="space-y-2 md:col-span-1">
        <x-ui.panel>
          <div class="flex flex-col items-center">
  
            <div class="relative">
              <x-profile.avatar :user="$isOwnProfile ? Auth::user() : $user" size="w-30 h-30"/>

              <form id="uploadForm" action="{{ route('profile.updatePicture') }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <input id="profile_pic" type="file" name="profile_pic" hidden  onchange="submitForm()">
              </form>

              <label for="profile_pic" class="p-2 rounded-full cursor-pointer absolute bottom-0 right-0 bg-blue-600">
                <x-icon.camera class="w-5 h-5 text-white" stroke="1.5"/>
              </label>
            </div>
  
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
            <x-ui.icon-item icon="users-gray" label="Seguindo" value="{{ $user->getFollowingCount() }}"/>
            <x-ui.icon-item icon="user-gray" label="Seguidores" value="{{ $user->getFollowersCount() }}"/>
            <x-ui.icon-item icon="comment-gray" label="Comentários" value="{{ $user->getCommentsCount() }}"/>
            <x-ui.icon-item icon="star-gray" label="Membro desde" value="{{ $user->created_at->year }}"/>
          </div>
        </x-ui.panel>
      </div>

      <x-ui.tab-container :default-tab="$isOwnProfile ? 'data' : 'posts'" class="md:col-span-2">
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
            <x-profile.tabs.data :$user/>
            <x-profile.tabs.read :$user/>
            <x-profile.tabs.saved :$user/>
            {{--<x-profile.tabs.notifications :$user/> --}}
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

<script>
  function submitForm(){
    document.querySelector('#uploadForm').submit();
  }
</script>