function actionButton(url, isActiveDefault, csrfToken) {
  return {
    isActive: isActiveDefault,
    loading: false,

    async toggleActive() {
      this.loading = true;

      let options = {
        method: this.isActive ? 'DELETE' : 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
        }
      };

      try {
        const response = await fetch(url, options);
        if (response.ok) {
          await new Promise(resolve => setTimeout(resolve, 300));
          this.isActive = !this.isActive;
        } else {
          let error = await response.json();
          console.log(error.error || 'Ocorreu um erro.');
        }
      } catch (e) {
        console.error(e);
        alert('Erro de conexão.');
      } finally {
        this.loading = false;
      }
    }
  }
}