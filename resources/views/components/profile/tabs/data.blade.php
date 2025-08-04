<div x-show="tab === 'data'" class="space-y-6">
  <form action="/profile" method="POST" class="space-y-6">
    @csrf
    @method('PATCH')

    <x-ui.panel>
      <x-section-heading>Informações pessoais</x-section-heading>
        <div class="space-y-4">
          <x-ui.forms.input name="name" value="{{ $user->name }}" label="Nome" placeholder="Nome"/>
          <x-ui.forms.input name="email" value="{{ $user->email }}" type="email" label="Email" placeholder="Email"/>
          <x-ui.forms.input name="bio" value="{{ $user->bio }}" label="Bio" placeholder="Bio" as="textarea"/>
          <x-ui.forms.input name="city" value="{{ $user->city }}" label="Cidade" placeholder="Cidade"/>
        </div>
    </x-ui.panel>

    <x-ui.panel>
      <x-section-heading>Redes sociais</x-section-heading>
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
    </x-ui.panel>

    <button type="submit">Salvar</button>
  </form>

  <x-ui.panel>
    <x-section-heading>Segurança</x-section-heading>
    <x-ui.forms.button variant="neutral" outline>Mudar senha</x-ui.forms.button>
  </x-ui.panel>
</div>