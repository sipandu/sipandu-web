<div class="modal fade" id="changePassword"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="last_password" class="col-form-label">Last Password</label>
                        <input wire:model="last_password" type="password" name="last_password" class="form-control" id="last_password" placeholder="Masukan password saat ini" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="col-form-label">New Password</label>
                        <input wire:model="password" type="password" name="password" class="form-control" id="password" placeholder="Masukan password baru" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="col-form-label">Confirm Password</label>
                        <input wire:model="password_confirmation" type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Masukan kembali password baru" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>