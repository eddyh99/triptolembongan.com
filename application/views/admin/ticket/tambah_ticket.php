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
                    <?php if (@isset($_SESSION["error"])) { ?>
                        <div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="notif-login f-poppins"><?= $_SESSION["error"] ?></span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <h5 class="card-title fw-semibold mb-4">Tambah Ticket</h5>
                    <form action="<?= base_url()?>ticket/tambah_process" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="mb-3">
                            <label for="tujuan" class="form-label">Tujuan</label>
                            <select name="tujuan" id="tujuan" class="form-select">
                                <option value="Sanur-Lembongan">Sanur - Lembongan</option>
                                <option value="Lembongan-Sanur">Lembongan - Sanur</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jam_keberangkatan" class="form-label">Jam Keberangkatan</label>
                            <input type="text" class="form-control jam_keberangkatan" id="jam_keberangkatan" name="jam_keberangkatan" >
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Tambah Ticket</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->
