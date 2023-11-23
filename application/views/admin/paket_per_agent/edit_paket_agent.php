<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>paket/paket_agent" class="btn btn-outline-primary d-flex align-items-center">
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
                    <h5 class="card-title fw-semibold mb-4">Edit Paket per Agent</h5>
                    <form action="<?= base_url()?>paket/tambah_paket_agent_process" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="row">
                            <div class="mb-4 col-6">
                                <label for="berlaku" class="form-label">Nama Agent</label>
                                <select class="nama-agent" name="id_agent">
                                    <option value="<?= $paket_agent['0']['id_nama']?>"><?= $paket_agent['0']['nama']?></option>
                                </select>
                            </div>
                            <div class="mb-4 col-6">
                            <label for="berlaku" class="form-label">Paket Agent</label>
                                <select class="paket" name="id_paket">
                                    <option value="<?= $paket_agent['0']['id']?>"><?= $paket_agent['0']['namapaket']?></option>
                                </select>
                            </div>
                         
                            <div class="mb-3 col-6">
                                <label for="harga" class="form-label ">Harga</label>
                                <input type="text" class="form-control money-input" id="harga" name="harga" >
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Edit Paket</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->
