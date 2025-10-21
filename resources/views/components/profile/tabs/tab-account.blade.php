<div x-show="tab === 'account'" class="space-y-2">
  <x-ui.base.panel tone="darker">
    <x-section-heading
      title="Preferências"
      desc="Confira ou edite suas preferências"
      class="mb-6"
    />

    <form 
      action="{{ route('settings.updatePreferences') }}" 
      method="POST" 
      class="space-y-4"
    >
      @csrf
      @method('PATCH')

      <div class="border-b-1 border-b-gray-200 dark:border-b-gray-700">
        <x-ui.interactive.toggle label="Perfil privado" name="is_private" :checked="$user->is_private"/>
      </div>

      <x-ui.forms.button size="sm">Salvar preferências</x-ui.forms.button>
    </form>
  </x-ui.base.panel>

  <x-ui.base.panel 
    x-data="{
      show: {{ $errors->any() ? 'true' : 'false' }},
      ...passwordForm({
        current: '',
        new: '',
        confirm: ''
      })
    }"
    id="seguranca"
    tone="darker"
  >
    <div class="flex items-center justify-between">
      <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Segurança</h2>
  
      <x-ui.forms.button
        @click="show=!show"
        variant="neutral"
        outline
        size="sm"
        icon="padlock"
      >
        <span x-text="show ? 'Ocultar' : 'Mostrar'"></span>
      </x-ui.forms.button>
    </div>

    <div 
      x-show="show"
      x-collapse.duration.1000ms
      class="mt-6 space-y-6"
    >
      <x-section-heading
        title="Alterar senha"
        desc="Altere sua senha para ter mais segurança"
        class="mb-4"
        size="sm"
      />

      <form 
        @submit.prevent="submit"
        action="{{ route('settings.updatePassword') }}" 
        method="POST" 
        class="space-y-4"
      >
        @csrf
        @method('PATCH')
        <div class="space-y-2">
          <x-ui.forms.input 
            x-model="fields.current" 
            type="password" 
            name="current_password" 
            x-error="errors.current"
            placeholder="Digite sua senha atual"
          />

          <x-ui.forms.input 
            x-model="fields.new" 
            type="password" name="password" 
            x-error="errors.new" 
            placeholder="Digite sua nova senha"
          />

          <x-ui.forms.input 
            x-model="fields.confirm" 
            type="password" 
            name="password_confirmation" 
            x-error="errors.confirm" 
            placeholder="Confirme sua nova senha"
          />
        </div>

        <x-ui.forms.button 
          type="button" 
          @click="submit($event)"
          size="sm"
        >
          <span x-show="!loading">Salvar</span>
          <x-ui.base.spinner x-show="loading"/>
        </x-ui.forms.button>
      </form>

      <hr class="text-gray-300 dark:text-slate-700">

      <div class="flex justify-between items-center">
        <x-section-heading
          title="Excluir conta"
          desc="Apagar esta conta e todos seus dados"
          class="mb-4"
          size="sm"
        />

        <form 
          action="{{ route('settings.deleteAccount') }}" 
          method="POST"
          class="flex gap-2"
        >
          @csrf
          @method('DELETE')

          <x-ui.forms.input name="passwordDelete" type="password" size="sm" required placeholder="Confirme sua senha"/>
          <x-ui.forms.button
            @click.prevent="$dispatch('open-modal', {
              title: 'Excluir conta?',
              content: 'Ao excluir sua conta, você perderá todos os seus posts. Tem certeza que deseja fazer isso?',
              onConfirm: () => $el.closest('form').submit()
            })"
            type="button"
            size="sm" 
            variant="danger"
          >
            Excluir conta
          </x-ui.forms.button>
        </form>
      </div>
    </div>
  </x-ui.base.panel>
</div>

<script src="{{ Vite::asset('resources/js/validations/password.js') }}"></script>
