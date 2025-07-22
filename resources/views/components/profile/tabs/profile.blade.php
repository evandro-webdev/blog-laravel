<div x-show="tab === 'profile'" class="space-y-6">
  <x-ui.panel>
    <x-section-heading>Informações pessoais</x-section-heading>

    <form action="" class="space-y-4">
      <x-ui.forms.input name="name" value="{{ $user->name }}" label="Nome" placeholder="Nome"/>
      <x-ui.forms.input name="email" value="{{ $user->email }}" type="email" label="Email" placeholder="Email"/>
      <x-ui.forms.input name="bio" label="Bio" placeholder="Bio" as="textarea"/>
      <x-ui.forms.input name="location" label="Cidade" placeholder="Cidade"/>
    </form>
  </x-ui.panel>

  <x-ui.panel>
    <x-section-heading>Redes sociais</x-section-heading>

    <form action="" class="space-y-4">
      <x-ui.forms.input name="x" label="X" placeholder="X"/>
      <x-ui.forms.input name="instagram" label="Instagram" placeholder="Bio" as="Instagram"/>
      <x-ui.forms.input name="linkedin" label="Linkedin" placeholder="Linkedin"/>
      <x-ui.forms.input name="github" label="Github" placeholder="Github"/>
    </form>
  </x-ui.panel>

  <x-ui.panel>
    <x-section-heading>Segurança</x-section-heading>
    <x-ui.forms.button variant="neutral" outline>Mudar senha</x-ui.forms.button>
  </x-ui.panel>
</div>