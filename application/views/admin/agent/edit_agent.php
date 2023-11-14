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
                    <h5 class="card-title fw-semibold mb-4">Edit Agent</h5>
                    <form action="<?= base_url()?>agent/edit_process" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" name="id_edit" value="<?= $agent->id?>">
                        <div class="mb-3">
                            <label for="nama_agent" class="form-label">Nama Agent</label>
                            <input type="text" class="form-control" id="nama_agent" name="nama_agent" value="<?= $agent->nama?>" placeholder="masukkan nama agent..." required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $agent->alamat?>" placeholder="masukkan alamat..." required>
                        </div>
                        <div class="mb-3">
                            <label for="kota" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota" value="<?= $agent->kota?>" placeholder="masukkan kota..." required>
                        </div>
                        <div class="mb-3">
                            <label for="kontak" class="form-label">Kontak</label>
                            <input type="number" class="form-control" id="kontak" name="kontak" value="<?= $agent->kontak?>" placeholder="masukkan kontak..." required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Perbaharui</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->

<!-- SWEET ALERT START -->
<?php if (isset($_SESSION["error_validation"])) { ?>
    <script>
        setTimeout(function() {
            Swal.fire({
                html: '<?= trim(str_replace('"', '', json_encode($_SESSION['error_validation']))) ?>',
                position: 'top',
                showCloseButton: true,
                showConfirmButton: false,
                icon: 'error',
                timer: 2500,
                timerProgressBar: true,
            });
        }, 100);
    </script>
<?php 
    } 
    if(isset($_SESSION["error"])) { 
?>
    <script>
        setTimeout(function() {
            Swal.fire({
                html: '<?= $_SESSION['error'] ?>',
                position: 'top',
                timer: 3000,
                showCloseButton: true,
                showConfirmButton: false,
                icon: 'error',
                timer: 2000,
                timerProgressBar: true,
            });
        }, 100);
    </script>
<?php } ?>


<!-- SWEET ALERT END -->


