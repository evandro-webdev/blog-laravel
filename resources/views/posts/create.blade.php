<x-layout class="dark:bg-slate-800">
  <x-section>
    <x-page-heading 
      title="Criar novo post" 
      subtitle="Preencha os campos abaixo para publicar um novo post."
      class="mb-6"
    />

    <form action="/admin/posts" method="POST" enctype="multipart/form-data" class="space-y-8">
      @csrf
      <div class="flex flex-col gap-6 md:flex-row">
        <div class="space-y-6 flex-1">
          <x-ui.forms.input name="title" label="Titulo" placeholder="O que esperar da tecnologia em..."/>
          <x-ui.forms.input 
            name="excerpt" 
            label="Resumo" 
            as="textarea" 
            placeholder="Resumo"
            tip="Um pequeno resumo que é exibido no card do post (opcional)"
          />

          <x-ui.forms.select name="category_id" label="Categoria" :options="$categories" placeholder="Selecione a categoria"/>

          <x-ui.forms.input 
            name="tags"
            label="Tags"
            placeholder="frontend, web, tailwind..."
            tip="Separe as tags por virgula"
          />
          <x-ui.forms.file-dropzone name="image"/>
        </div>
  
        <div class="flex-1 space-y-6">
          <x-ui.forms.input name="content" label="Conteúdo" as="textarea"/>
          
          <div class="space-y-4">
            <x-ui.forms.checkbox 
              name="published"
              label="Publicado"
              tip="Torna o post visivel para todos"
            />

            <div id="featured-container">
              <x-ui.forms.checkbox 
                name="featured" 
                label="Destaque"
                tip="Exibe o post em destaque no seu perfil público"
              />
            </div>
          </div>
        </div>
      </div>
      <x-ui.forms.button class="w-full ml-auto md:w-auto">Publicar</x-ui.forms.button>
    </form>
  </x-section>
  
  @push('scripts')
    <script src="https://cdn.tiny.cloud/1/3qqrdxghokajgnwrpufmupg41lyo1e5llr6bymftc3btdx6v/tinymce/8/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
      function initTinymce(isDark){
        tinymce.remove()
        
        tinymce.init({
          selector: '#content',
          language: 'pt_BR',
          language_url: '/js/lang/pt_BR.js',
          menubar: false,
          plugins: [
            'fullscreen', 'placeholder', 'anchor', 'autolink', 'charmap', 'codesample',
            'emoticons', 'lists', 'image', 'link', 'media', 'searchreplace',
            'table', 'visualblocks', 'wordcount'
          ],
          placeholder: 'Escreva aqui o conteúdo do post...',
          toolbar: 'styles | bold italic underline strikethrough | numlist bullist | outdent indent | fullscreen link image ',
          branding: false,
          skin: isDark ? 'oxide-dark' : 'oxide',
          content_css: isDark ? 'dark' : 'default'
        });
      }

      document.addEventListener('DOMContentLoaded', function () {
        const isDark = localStorage.getItem('theme') === 'dark'
        if (isDark) document.documentElement.classList.add('dark')
        initTinymce(isDark)
      })
    </script>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
       const published = document.querySelector('input[name="published"]'); 
       const featured = document.querySelector('input[name="featured"]');
       const featuredContainer = document.querySelector('#featured-container');

       if(published && featuredContainer && featured){
        function updateFeaturedVisibility(){
          if(published.checked){
            featuredContainer.style.display = 'block';
          } else {
            featuredContainer.style.display = 'none';
            featured.checked = false;
          }
        }

        updateFeaturedVisibility();

        published.addEventListener('change', updateFeaturedVisibility);
       }
      })
    </script>
  @endpush
</x-layout>

