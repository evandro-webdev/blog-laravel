<div x-show="tab === 'data'" class="space-y-6">
  <form action="/profile" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <x-ui.panel>
      <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-800">Informações pessoais</h2>
        <x-ui.forms.button size="sm">Salvar</x-ui.forms.button>
      </div>
      <div class="mt-6 space-y-4">
        <x-ui.forms.input name="name" value="{{ $user->name }}" label="Nome" placeholder="Nome"/>
        <x-ui.forms.input name="email" value="{{ $user->email }}" type="email" label="Email" placeholder="Email"/>
        <x-ui.forms.input name="bio" value="{{ $user->bio }}" label="Bio" placeholder="Bio" as="textarea"/>
        <x-ui.forms.input name="city" value="{{ $user->city }}" label="Cidade" placeholder="Cidade"/>
      </div>
    </x-ui.panel>

    <x-ui.panel>
      <h2 class="text-2xl font-bold text-gray-800">Redes sociais</h2>
      
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
      <h2 class="text-2xl font-bold text-gray-800">Segurança</h2>
  
      <x-ui.forms.button
        @click="show=!show"
        variant="neutral"
        outline
        size="sm"
      >
        <span x-text="show ? 'Cancelar' : 'Alterar senha'"></span>
      </x-ui.forms.button>
    </div>

    <form 
      x-show="show"
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
        {{-- <x-ui.forms.error :error="$errors->first($name)"/> --}}

        <x-ui.forms.input x-model="fields.new" type="password" name="password" x-error="errors.new" placeholder="Digite sua nova senha"/>
        <x-ui.forms.input x-model="fields.confirm" type="password" name="password_confirmation" x-error="errors.confirm" placeholder="Confirme sua nova senha"/>
      </div>
      <x-ui.forms.button type="button" @click="submit($event)">Salvar</x-ui.forms.button>
    </form>
  </x-ui.panel>
</div>

<script>
  function passwordForm(initial){
    return {
      fields: { ...initial },
      errors: {},

      validate() {
        this.errors = {};

        if(!this.fields.current){
          this.errors.current = 'Digite sua senha atual';
        }

        if(!this.fields.new){
          this.errors.new = 'Digite sua nova senha';
        }else if(this.fields.new.length < 6){
          this.errors.new = 'A nova senha precisa ter pelo menos 6 caracteres';          
        }

        if(this.fields.new !== this.fields.confirm){
          this.errors.confirm = 'A confirmação de senha não confere';
        }

        return Object.keys(this.errors).length === 0;
      },

      submit(event){
        if (this.validate()) {
          event.target.closest("form").submit();
        }
      }
    }
  }
</script>