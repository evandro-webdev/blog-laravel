<form 
  x-show="editing"
  x-cloak
  x-collapse
  @submit.prevent="updateComment({{ $comment->id }})"
  class="space-y-3"
>
  <x-ui.forms.input 
    x-model="content" 
    name="content" 
    as="textarea"
  />

  <div class="flex gap-2 justify-end">
    <x-ui.forms.button
      @click="cancelEdit()"
      variant="neutral"
      size="sm"
      type="button"
    >
      Cancelar
    </x-ui.forms.button>

    <x-ui.forms.button
      type="submit"
      size="sm"
      @click="editing=false"
    >
      Salvar
    </x-ui.forms.button>
  </div>
</form>