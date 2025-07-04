<x-layout>
  <section class="w-full max-w-[600px] mx-auto px-2 md:px-4 py-8 md:py-14 lg:py-20">
    <x-page-heading title="Criar conta" subtitle="Preencha os campos abaixo para criar sua conta."/>

    <form action="/register" method="POST" class="space-y-8">
      @csrf
      <div class="space-y-6">
        <x-ui.forms.input name="name" label="Nome" placeholder="John Doe"/>
        <x-ui.forms.input type="email" name="email" label="Email" placeholder="johndoe@email.com"/>
        <x-ui.forms.input type="password" name="password" label="Senha" placeholder="Digite sua senha"/>
        <x-ui.forms.input type="password" name="password_confirmation" label="Confirmação de senha" placeholder="Digite sua senha novamente"/>
      </div>
      <x-ui.forms.button>Criar conta</x-ui.forms.button>
    </form>
  </section>
</x-layout>