function passwordForm(initial){
    return {
      fields: { ...initial },
      errors: {},
      loading: false,

      validate() {
        this.errors = {};

        if(!this.fields.current){
          this.errors.current = 'Digite sua senha atual';
        }

        if(!this.fields.new){
          this.errors.new = 'Digite sua nova senha';
        }else if(this.fields.new.length < 6){
          this.errors.new = 'A nova senha precisa ter pelo menos 6 caracteres';          
        }else if(this.fields.new === this.fields.current){
          this.errors.new = 'A nova senha não pode ser igual a antiga';          
        }

        if(this.fields.new !== this.fields.confirm){
          this.errors.confirm = 'A confirmação de senha não confere';
        }

        return Object.keys(this.errors).length === 0;
      },

      submit(event){
        if (this.validate()) {
          this.loading = true;
          setTimeout(() => {
            event.target.closest("form").submit();
        }, 300);
        }
      }
    }
  }