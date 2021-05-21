<div class="modal fade" id="statusKonsultasi"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Status Konsultasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('edit.status.admin')}}" method="POST">
                @csrf
                <div class="modal-body text-center">
                    <div class="row">
                        @if (Auth::guard('admin')->user()->pegawai->status == 'tersedia')
                            <div class="col-6">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input"  type="radio"  value="tersedia" id="customRadio2" name="customRadio" checked >
                                    <label for="customRadio2" class="custom-control-label">Tersedia</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input"  type="radio" value="tidak tersedia" id="customRadio1" name="customRadio" >
                                    <label for="customRadio1" class="custom-control-label">Tidak Tersedia</label>
                                </div>
                            </div>
                        @endif
                        @if (Auth::guard('admin')->user()->pegawai->status=='tidak tersedia')
                            <div class="col-6">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input"  type="radio"  value="tersedia" id="customRadio2" name="customRadio" >
                                    <label for="customRadio2" class="custom-control-label">Tersedia</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input"  type="radio" value="tidak tersedia" id="customRadio1" name="customRadio" checked >
                                    <label for="customRadio1" class="custom-control-label">Tidak Tersedia</label>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="cancle" class="btn btn-sm btn-outline-warning" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-outline-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>


</script>
