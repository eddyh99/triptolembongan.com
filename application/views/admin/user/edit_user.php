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
                    <?php if (@isset($_SESSION["error"])) { ?>
                        <div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="notif-login f-poppins"><?= $_SESSION["error"] ?></span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <h5 class="card-title fw-semibold mb-4">Edit Pengguna</h5>
                    <form action="<?= base_url()?>user/edit_process" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="mb-3">
                            <label for="nama_agent" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $user->username?>" placeholder="masukkan nama agent..." required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Password</label>
                            <input type="password" class="form-control" id="passwd" name="passwd" placeholder="masukkan password...">
                            <small class="text-danger">*kosongkan jika tidak ingin mengganti password</small>
                        </div>
                        <div class="mb-3 col-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select">
                                <option value="kasir" <?=($user=="kasir")?"selected":""?>>Kasir</option>
                                <option value="marketing" <?=($user=="marketing")?"selected":""?>>Marketing</option>
                                <option value="admin" <?=($user=="admin")?"selected":""?>>Admin</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Perbaharui</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->

