<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>user" class="btn btn-outline-primary d-flex align-items-center">
                
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
                    <h5 class="card-title fw-semibold mb-4">Tambah Pengguna</h5>
                    <form action="<?= base_url()?>user/tambah_process" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="masukkan username..." required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="passwd" name="passwd" placeholder="masukkan password..." required>
                        </div>
                        <div class="mb-3 col-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select">
                                <option value="kasir">Kasir</option>
                                <option value="marketing">Marketing</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Daftar</button>
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


