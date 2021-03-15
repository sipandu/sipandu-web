<div class="modal fade" id="editPosyandu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editPosyanduLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="edtiPosyanduLabel">Edit Data Posyandu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        @foreach ($dataPosyandu as $posyandu)
            <form action="{{route('Update Posyandu', [$posyandu->id])}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputNama">Nama Posyandu</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="nama" id="inputNama" value="{{ $posyandu->nama_posyandu }}" placeholder="Masukan nama posyandu">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-clinic-medical"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputBanjar">Banjar</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Banjar</span>
                            <input type="text" class="form-control" name="banjar" id="inputBanjar" value="{{ $posyandu->banjar }}" placeholder="Masukan lokasi banjar">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-city"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTelp">Nomor Telepon</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="telp" id="inputTelp" value="{{ $posyandu->nomor_telepon }}" placeholder="Masukan nomor telepon posyandu">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone-alt"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAlamat">Alamat</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="alamat" id="inputAlamat" value="{{ $posyandu->alamat }}" placeholder="Masukan alamat posyandu">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-road"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputLay">Koordinat Latitude</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="lat" id="inputLat" value="{{ $posyandu->latitude }}" placeholder="Masukan koordinat Latitude posyandu">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-map-marker-alt"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputLng">Koordinat Longitude</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="lng" id="inputLng" value="{{ $posyandu->longitude }}" placeholder="Masukan koordinat Longitude posyandu">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-map-marker-alt"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-danger" data-bs-dismiss="modal">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        @endforeach
        </div>
    </div>
</div>