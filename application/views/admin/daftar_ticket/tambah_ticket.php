<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>ticket" class="btn btn-outline-primary d-flex align-items-center">
                <i class="ti ti-chevron-left fs-5 me-2"></i>
                <span>
                    Kembali
                </span>
            </a>
        </div>
    </div>
    <!--  Row Daftar User Agent -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Tambah Ticket</h5>
                    <form>
                        <div class="mb-3">
                            <label for="tujuan" class="form-label">Tujuan</label>
                            <input type="text" class="form-control" id="tujuan" name="tujuan" >
                            <div id="emailHelp" class="form-text">Cth: Lembongan - Sanur</div>
                        </div>
                        <div class="mb-3">
                            <label for="jam_keberangkatan" class="form-label">Jam Keberangkatan</label>
                            <input type="text" class="form-control jam_keberangkatan" id="jam_keberangkatan" name="jam_keberangkatan" >
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga" >
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Daftar</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->
