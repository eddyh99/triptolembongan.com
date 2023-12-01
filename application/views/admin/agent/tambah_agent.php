<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>agent" class="btn btn-outline-primary d-flex align-items-center">
                
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
                    <h5 class="card-title fw-semibold mb-4">Tambah Agent</h5>
                    <form action="<?= base_url()?>agent/tambah_process" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="mb-4 col-12 col-md-6 ">
                            <label for="freecharge" class="form-label">Tipe Agent</label>
                            <div class="d-flex ">
                                <div class="form-check">
                                    <input class="form-check-input cursor-pointer" type="radio" name="tipe" id="onewayradio" value="general" >
                                    <label class="form-check-label cursor-pointer" for="onewayradio">
                                        General
                                    </label>
                                </div>
                                <div class="form-check ms-3">
                                    <input class="form-check-input cursor-pointer" type="radio" name="tipe" id="returnradio" value="company" checked="checked">
                                    <label class="form-check-label cursor-pointer" for="returnradio">
                                        Company
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nama_agent" class="form-label">Nama Agent</label>
                            <input type="text" class="form-control" id="nama_agent" name="nama_agent" placeholder="masukkan nama agent...">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="masukkan alamat..." >
                        </div>
                        <div class="mb-3">
                            <label for="kota" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota" placeholder="masukkan kota..." >
                        </div>
                        <div class="mb-3">
                            <label for="kontak" class="form-label">Kontak</label>
                            <input type="number" class="form-control" id="kontak" name="kontak" placeholder="masukkan kontak..." >
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Daftar</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->


