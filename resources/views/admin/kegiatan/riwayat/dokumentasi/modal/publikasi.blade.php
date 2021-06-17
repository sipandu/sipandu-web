<div class="modal fade" id="publikasi" tabindex="-1" aria-labelledby="publikasiLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="publikasiLabel">Status Publikasi Kegiatan</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form action="" id="formPublikasi" method="POST">
                  @csrf
                  <div class="row">
                      <div class="col-7 d-grid">
                          <select class="form-select" name="status" id="statusPublikasi">
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