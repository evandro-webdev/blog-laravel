<div x-show="tab === 'data'" class="space-y-6">
  <form action="{{ route('profile.update', $user) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <x-ui.panel>
      <div class="mb-8 flex items-center justify-between">
        <x-section-heading
          title="Informações pessoais"
          desc="Confira ou atualize suas informações pessoais"
        />
        <x-ui.forms.button size="sm">Salvar</x-ui.forms.button>
      </div>
      <div class="space-y-4">
        <x-ui.forms.input name="name" value="{{ $user->name }}" label="Nome" placeholder="Nome"/>
        <x-ui.forms.input name="username" value="{{ $user->username }}" label="Nome de usuário" placeholder="Nome de usuário"/>
        <x-ui.forms.input name="email" value="{{ $user->email }}" type="email" label="Email" placeholder="Email"/>
        <x-ui.forms.input name="bio" value="{{ $user->bio }}" label="Bio" placeholder="Bio" as="textarea"/>
        <x-ui.forms.input name="city" value="{{ $user->city }}" label="Cidade" placeholder="Cidade"/>
      </div>
    </x-ui.panel>

    <x-ui.panel>
      <x-section-heading
        title="Redes sociais"
        desc="Conecte-se com seus seguidores pelas redes sociais"
        class="mb-8"
      />
      
      <div class="mt-6 space-y-4">
        <x-ui.forms.input 
          type="url" 
          name="twitter" 
          label="Twitter" 
          :value="old('twitter', $user->socialProfiles->where('provider', 'twitter')->first()?->url)"
          placeholder="https://twitter.com/..."
        />
        
        <x-ui.forms.input 
          type="url" 
          name="github" 
          label="GitHub" 
          :value="old('github', $user->socialProfiles->where('provider', 'github')->first()?->url)"
          placeholder="https://github.com/..."
        />
        
        <x-ui.forms.input 
          type="url" 
          name="instagram" 
          label="Instagram" 
          :value="old('instagram', $user->socialProfiles->where('provider', 'instagram')->first()?->url)"
          placeholder="https://instagram.com/..."
        />
        
        <x-ui.forms.input 
          type="url" 
          name="linkedin" 
          label="LinkedIn" 
          :value="old('linkedin', $user->socialProfiles->where('provider', 'linkedin')->first()?->url)"
          placeholder="https://linkedin.com/in/..."
        />
        
        <x-ui.forms.input 
          type="url" 
          name="youtube" 
          label="YouTube" 
          :value="old('youtube', $user->socialProfiles->where('provider', 'youtube')->first()?->url)"
          placeholder="https://youtube.com/@..."
        />
      </div>
    </x-ui.panel>
  </form>
</div>