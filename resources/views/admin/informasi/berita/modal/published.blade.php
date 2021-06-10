<div class="modal fade" id="published" tabindex="-1" aria-labelledby="publishedLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="publishedLabel">Status Publikasi Berita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Status Berita', $item->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-7 d-grid">
                            <select class="form-select" name="status" aria-label="Default select example">`
                                @if ( $item->status == 'Aktif' )
                                    <option selected value="Aktif">Ditampilkan</option>
                                    <option value="Tidak Aktif">Tidak Ditampilkan</option>
                                @else
                                    <option selected value="Tidak Aktif">Tidak Ditampilkan</option>
                                    <option value="Aktif">Ditampilkan</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-5 d-grid">
                            <button type="submit" class="btn btn-success">Simpan Status</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>