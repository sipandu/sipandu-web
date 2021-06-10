<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="delete-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-modal">Batalkan Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kegiatan.delete', $item->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kegiatan</label>
                        <input type="text" class="form-control" id="nama-kegiatan" value="{{ $item->nama_kegiatan }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="alasan">Pesan Pembatalan</label>
                        <textarea name="alasan" class="form-control @error('alasan') is-invalid @enderror" placeholder="Masukan alasan pembatalan kegiatan" id="alasan" required></textarea>
                        @error('alasan')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @else
                            <div class="invalid-feedback">
                                Alasan Pembatalan Kegiatan Wajib Diisi
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Batalkan Kegiatan</button>
                </div>
            </form>
        </div>
    </div>
</div>