<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="delete-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-modal">Batalkan Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="formBatalkanKegiatan" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kegiatan<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama-kegiatan" value="" readonly>
                    </div>
                    <div class="form-group ">
                        <label for="alasan">Pesan Pembatalan<span class="text-danger">*</span></label>
                        <textarea name="alasan" id="" class="form-control @error('alasan') is-invalid @enderror" id="alasan" placeholder="Masukan alasan pembatalan kegiatan" cols="20" rows="10" required>{{ old('alasan') }}</textarea>
                        @error('alasan')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @else
                            <div class="invalid-feedback">
                                Alasan Pembatan Kegiatan Wajib Diisi
                            </div>
                        @enderror
                    </div>
                    <p class="text-danger text-end my-1"><span>*</span> Data wajib diisi</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-danger">Batalkan Kegiatan</button>
                </div>
            </form>
        </div>
    </div>
</div>