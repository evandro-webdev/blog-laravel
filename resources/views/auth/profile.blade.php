<x-layout>
  <x-section>
    <x-page-heading title="Meu perfil" subtitle="Manage your reading preferences and account settings"/>
    <div class="grid gap-2">
      <x-ui.panel>
        <div class="flex flex-col items-center">
          <div class="w-24 h-24 rounded-full bg-gray-200">
            <img src="" alt="">
          </div>
          <h3 class="my-3 font-bold text-gray-800">John Doe</h3>
          <x-ui.badge pill small variant='white'>Leitor</x-ui.badge>

          <div class="w-full mt-4 flex justify-around">
            <div class="text-center">
              <span class="text-xl font-bold text-blue-600">27</span>
              <p class="text-sm text-gray-500">Posts lidos</p>
            </div>

            <div class="text-center">
              <span class="text-xl font-bold text-blue-600">15</span>
              <p class="text-sm text-gray-500">Posts salvos</p>
            </div>
          </div>
        </div>
      </x-ui.panel>

      <x-ui.panel>
        <h3 class="mb-6 font-bold text-gray-800">Estatisticas de leitura</h3>

        <div class="space-y-2">

          <div class="flex items-center justify-between text-gray-800">
            <div class="flex items-center gap-2">
              <img src="{{ asset('images/icons/comment-gray.svg') }}"><span class="text-sm font-medium">Comentários</span>
            </div> 
            <span class="font-bold">43</span>
          </div>

          <div class="flex items-center justify-between text-gray-800">
            <div class="flex items-center gap-2">
              <img src="{{ asset('images/icons/users-gray.svg') }}"><span class="text-sm font-medium">Seguindo</span>
            </div> 
            <span class="font-bold">43</span>
          </div>

          <div class="flex items-center justify-between text-gray-800">
            <div class="flex items-center gap-2">
              <img src="{{ asset('images/icons/user-gray.svg') }}"><span class="text-sm font-medium">Seguidores</span>
            </div> 
            <span class="font-bold">43</span>
          </div>

          <div class="flex items-center justify-between text-gray-800">
            <div class="flex items-center gap-2">
              <img src="{{ asset('images/icons/star-gray.svg') }}"><span class="text-sm font-medium">Membro desde</span>
            </div> 
            <span class="font-bold">2024</span>
          </div>

        </div>
      </x-ui.panel>
    </div>

  </x-section>
</x-layout>
