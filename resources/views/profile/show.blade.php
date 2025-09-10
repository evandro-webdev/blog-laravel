<x-layout>
  <x-section>
    <div class="grid md:grid-cols-3 gap-2">
      <div class="space-y-2 md:col-span-1">
        <x-ui.panel>
          <div class="space-y-3 flex flex-col items-center">
  
            <div class="relative">
              <x-profile.avatar :user="$isOwnProfile ? Auth::user() : $user" size="w-30 h-30"/>

              @if ($isOwnProfile)
                <form id="uploadForm" action="{{ route('profile.updatePicture') }}" method="POST" enctype="multipart/form-data">
                  @method('PATCH')
                  @csrf
                  <input id="profile_pic" type="file" name="profile_pic" hidden  onchange="submitForm()">
                </form>

                <label for="profile_pic" class="p-2 rounded-full cursor-pointer absolute bottom-0 right-0 bg-blue-600">
                  <x-ui.icons.camera class="text-white"/>
                </label> 
              @endif
            </div>
            
            <div class="space-y-1 text-center">
              <h3 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h3>
              <x-ui.badge small variant="white">Desde {{ $user->created_at->year }}</x-ui.badge>
            </div>

            <div class="w-full flex justify-around">
              <div class="text-center">
                <span class="text-xl font-bold text-blue-600">{{ $user->getFollowersCount() }}</span>
                <p class="text-sm text-gray-500">Seguidores</p>
              </div>
              <div class="text-center">
                <span class="text-xl font-bold text-blue-600">{{ $user->getFollowingCount() }}</span>
                <p class="text-sm text-gray-500">Seguindo</p>
              </div>
              <div class="text-center">
                <span class="text-xl font-bold text-blue-600">{{ $user->posts()->count() }}</span>
                <p class="text-sm text-gray-500">Publicações</p>
              </div>
            </div>
  
            <x-ui.follow-button :$user/>

            @if($user->is_private && !$isOwnProfile)
              <div class="p-4 text-sm text-gray-600 rounded mb-4 text-center bg-gray-50">
                Este perfil é privado. Apenas seguidores aprovados podem ver os posts e atividades.
              </div>
            @endif
          </div>
        </x-ui.panel>

        @if (!$user->is_private || $isOwnProfile)
          <x-ui.panel>
            <h3 class="mb-4 font-bold text-gray-800">Sobre</h3>

            <div class="space-y-4">
              <p class="text-sm text-gray-800">{{ $user->bio }}</p>
              <div class="space-y-3">
                <x-ui.icon-item icon="local" label="{{ $user->city ?? 'Não informado' }}"/>
                <x-ui.icon-item icon="calendar" label="Entrou em {{ $user->created_at->translatedFormat('d \d\e F, Y') }}"/>
              </div>

              @if ($user->socialProfiles->count() > 0) 
                <div class="flex gap-2">
                  @foreach ($user->socialProfiles as $socialProfile)
                    <x-ui.forms.button
                      href="{{ $socialProfile->url }}"
                      variant="neutral" 
                      outline 
                      size="sm"
                    >
                      {{ Str::ucfirst($socialProfile->provider) }}
                    </x-ui.forms.button>
                  @endforeach
                </div>
              @endif
            </div>
          </x-ui.panel>
        @endif
      </div>

      <x-ui.tab-container :default-tab="$isOwnProfile ? 'data' : 'posts'" class="space-y-2 md:col-span-2">
        <x-slot:tabs>
          @if($isOwnProfile)
            <x-ui.tab value="data" x-model="tab" icon="user-data">Dados</x-ui.tab>
            <x-ui.tab value="read" x-model="tab" icon="eye">Lidos ({{ $user->readPosts->count() }})</x-ui.tab>
            <x-ui.tab value="saved" x-model="tab" icon="save">Salvos ({{ $user->savedPosts->count() }})</x-ui.tab>
            <x-ui.tab value="preferences" x-model="tab" icon="preferences">Preferências</x-ui.tab>
          @else
            <x-ui.tab value="posts" x-model="tab">Posts</x-ui.tab>
            <x-ui.tab value="activity" x-model="tab">Atividade</x-ui.tab>
            <x-ui.tab value="about" x-model="tab">Sobre</x-ui.tab>
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