<div class="modal fade" id="editAdminPosyandu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editAdminPosyanduLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editAdminPosyanduLabel">Manage Admin Posyandu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="">
            <div class="modal-body">
                @foreach ($dataPosyandu as $posyandu)
                    <div class="form-group">
                        <label for="inputDesa">Non-aktifkan Administrator</label>
                        <div class="input-group mb-3">
                            <input class="form-control @error('pegawai') is-invalid @enderror" name="pegawai" list="dataPegawai" id="inputPegawai" value="{{ old('pegawai') }}" placeholder="Cari admin {{ $posyandu->nama_posyandu }}..." autocomplete="off">
                            <datalist id="dataPegawai">
                                @foreach ($pegawai->where('id_posyandu', $posyandu->id) as $pgw)
                                    <option value="{{ $pgw->nama_pegawai }}">
                                @endforeach
                            </datalist>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-city"></span>
                                </div>
                            </div>
                            @error('pegawai')
                                <div class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputBanjar">NIK Admin</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" id="inputBanjar" value="{{ old('nik') }}" placeholder="Masukan NIK Admin">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-city"></span>
                                </div>
                            </div>
                            @error('nik')
                                <div class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger" data-bs-dismiss="modal">Batal</a>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan Perubahan</button>
            </div>
        </form>
        </div>
    </div>
</div>