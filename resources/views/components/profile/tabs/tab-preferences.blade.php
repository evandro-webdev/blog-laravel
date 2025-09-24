<div x-show="tab === 'preferences'" class="space-y-6">
  <x-ui.panel>
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
        <x-ui.toggle label="Perfil privado" name="is_private" :checked="$user->is_private"/>
      </div>

      <x-ui.forms.button size="sm">Salvar preferências</x-ui.forms.button>
    </form>
  </x-ui.panel>

  <x-ui.panel 
    x-data="{
      show: {{ $errors->any() ? 'true' : 'false' }},
      ...passwordForm({
        current: '',
        new: '',
        confirm: ''
      })
    }"
    id="seguranca"
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
        <span x-text="show ? 'Cancelar' : 'Alterar senha'"></span>
      </x-ui.forms.button>
    </div>

    <form 
      x-show="show"
      x-collapse.duration.1000ms
      @submit.prevent="submit"
      action="{{ route('settings.updatePassword') }}" 
      method="POST" 
      class="mt-6 space-y-6"
    >
      @csrf
      @method('PATCH')
      <div class="space-y-4">
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
      >
        <span x-show="!loading">Salvar</span>
        <x-ui.spinner x-show="loading"/>
      </x-ui.forms.button>
    </form>

    <x-ui.flash :message="session('success')" />
    <x-ui.toast position="center-top"/>
  </x-ui.panel>
</div>

<script src="{{ Vite::asset('resources/js/validations/password.js') }}"></script>
