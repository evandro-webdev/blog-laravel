function followButton(userId, isFollowingDefault, csrfToken) {
  return {
    isFollowing: isFollowingDefault,
    loading: false,

    async toggleFollow() {
      this.loading = true;

      let url = `/user/${userId}/follow`;
      let options = {
        method: this.isFollowing ? 'DELETE' : 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
        }
      };

      try {
        const response = await fetch(url, options);
        if (response.ok) {
          await new Promise(resolve => setTimeout(resolve, 300));
          this.isFollowing = !this.isFollowing;
        } else {
          let error = await response.json();
          alert(error.error || 'Ocorreu um erro.');
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