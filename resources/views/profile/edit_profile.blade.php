<!-- edit_profile.blade.php -->
<form id="edit-profile-form" method="POST" action="{{ url('profile/update_profile') }}" enctype="multipart/form-data">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editProfileModalLabel">Ganti Foto Profil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="avatar">Pilih Foto Profil</label>
                <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                <small class="form-text text-muted">Format: jpeg, png, jpg, gif (max 5MB)</small>
                @error('avatar')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </div>
</form>

<!-- Script to preview selected image before uploading -->
<script>
    document.getElementById('avatar').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('profile-pic');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>

<!-- CSS Styling for preview -->
<style>
    #profile-pic {
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 50%;
        width: 200px;
        height: 200px;
    }
</style>
