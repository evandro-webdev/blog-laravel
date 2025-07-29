<div x-show="tab === 'profile'" class="space-y-6">
  <form action="" class="space-y-6">
    <x-ui.panel>
      <x-section-heading>Informações pessoais</x-section-heading>
        <div class="space-y-4">
          <x-ui.forms.input name="name" value="{{ $user->name }}" label="Nome" placeholder="Nome"/>
          <x-ui.forms.input name="email" value="{{ $user->email }}" type="email" label="Email" placeholder="Email"/>
          <x-ui.forms.input name="bio" label="Bio" placeholder="Bio" as="textarea"/>
          <x-ui.forms.input name="location" label="Cidade" placeholder="Cidade"/>
        </div>
    </x-ui.panel>

    <x-ui.panel>
      <x-section-heading>Redes sociais</x-section-heading>
      <div class="space-y-4">
        <input type="hidden" name="social_networks[0][provider]" value="twitter">
        <x-ui.forms.input type="url" name="social_networks[0][url]" label="Twitter" placeholder="https://twitter.com/..." />
        
        <input type="hidden" name="social_networks[1][provider]" value="github">
        <x-ui.forms.input type="url" name="social_networks[1][url]" label="Github" placeholder="https://github.com/..." />

        <input type="hidden" name="social_networks[1][provider]" value="instagram">
        <x-ui.forms.input type="url" name="social_networks[1][url]" label="Instagram" placeholder="https://instagram.com/..." />
      </div>
    </x-ui.panel>
  </form>

  <x-ui.panel>
    <x-section-heading>Segurança</x-section-heading>
    <x-ui.forms.button variant="neutral" outline>Mudar senha</x-ui.forms.button>
  </x-ui.panel>
</div>