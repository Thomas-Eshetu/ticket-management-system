<style>
    .modal-body {
        font-size: 0.85rem;
    }
</style>

<div class="modal fade" data-bs-backdrop="static" id="changePasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Change Password <i class="fa-solid fa-lock"></i></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('staff.changePassword') }}" method="post">
                    @csrf
                    <div class="mb-2">
                        <label for="" class="form-label">Old Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control form-control-sm" name="oldPass" id="oldPass"
                                required>
                            <span class="input-group-text" onclick="togglePassword('oldPass', this)">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                        </div>
                        @error('oldPass')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control form-control-sm" name="newPass" id="newPass"
                                required>
                            <span class="input-group-text" onclick="togglePassword('newPass', this)">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                        </div>
                        @error('newPass')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Retype New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control form-control-sm" name="retypePass"
                                id="retypePass" required>
                            <span class="input-group-text" onclick="togglePassword('retypePass', this)">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                        </div>
                        @error('retypePass')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success btn-sm">Change <i
                                class="fa-solid fa-arrows-rotate"></i></button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <small class="text-muted">Yegna Ticketing System</small>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(id, el) {
        const input = document.getElementById(id);
        const icon = el.querySelector('i');

        if (input.type === "password") {
            input.type = "text";
            icon.classList.replace("fa-eye", "fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.replace("fa-eye-slash", "fa-eye");
        }
    }
</script>
