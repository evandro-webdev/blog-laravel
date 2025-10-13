@props([
  'user'
])

<form 
  id="uploadForm" 
  action="{{ route('profile.updatePicture', $user) }}" 
  method="POST" 
  enctype="multipart/form-data"
>
  @method('PATCH')
  @csrf
  <input id="profile_pic" type="file" accept="image/jpeg,image/webp" name="profile_pic" hidden onchange="this.form.submit()">
</form>

<label for="profile_pic" class="p-2 rounded-full cursor-pointer absolute bottom-0 right-0 bg-blue-600 hover:bg-blue-700 transition-colors">
  <x-ui.icons.camera class="text-white"/>
</label>