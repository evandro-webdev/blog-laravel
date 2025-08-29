function saveButton(postId, isSavedDefault, csrfToken) {
  return {
    isSaved: isSavedDefault,
    loading: false,

    async toggleSave() {
      this.loading = true;

      let url = `/posts/${postId}/save`;
      let options = {
        method: this.isSaved ? 'DELETE' : 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
        }
      };

      try {
        const response = await fetch(url, options);
        if (response.ok) {
          await new Promise(resolve => setTimeout(resolve, 300));
          this.isSaved = !this.isSaved;
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