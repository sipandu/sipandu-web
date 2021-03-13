<div class="modal fade" id="edtiPosyandu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="edtiPosyanduLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="edtiPosyanduLabel">Edit Data Posyandu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @foreach ($dataPosyandu as $posyandu)
                <div class="form-group">
                    <label for="inputBanjar">Banjar</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="banjar" id="inputBanjar" value="{{ $posyandu->banjar }}" placeholder="Masukan lokasi banjar">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-city"></span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-success">Simpan Perubahan</button>
        </div>
        </div>
    </div>
</div>