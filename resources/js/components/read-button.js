function readButton(postId, isReadDefault, csrfToken) {
  return {
    isRead: isReadDefault,
    loading: false,

    async toggleRead() {
      this.loading = true;

      let url = `/posts/${postId}/read`;
      let options = {
        method: this.isRead ? 'DELETE' : 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
        }
      };

      try {
        const response = await fetch(url, options);
        if (response.ok) {
          await new Promise(resolve => setTimeout(resolve, 300));
          this.isRead = !this.isRead;
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