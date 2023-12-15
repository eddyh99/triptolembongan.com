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
                        <!-- <div class="mb-3 col-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select">
                                <option value="kasir">Kasir</option>
                                <option value="marketing">Marketing</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div> -->
                        <div class="col-12 d-flex">
                            <label class="form-label">Menu Checklist</label>
                        </div>
                        <div class="col-12 d-flex flex-wrap">
                            <div class="border border-primary mx-2 p-2 roun mt-2 rounded" 
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Home">
                                <input type="checkbox" id="dash" name="dash" value="dash" class="form-check-input">
                                <label for="dash">Dashboard</label>
                            </div>
                            <div class="border border-primary mx-2 p-2 roun mt-2 rounded"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Master">
                                <input type="checkbox" id="stu" name="stu" value="stu" class="form-check-input">
                                <label for="stu">Setup User</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Master">
                                <input type="checkbox" id="stag" name="stag" value="stag" class="form-check-input">
                                <label for="stag">Setup Agent</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Master">
                                <input type="checkbox" id="stpy" name="stpy" value="stpy" class="form-check-input">
                                <label for="stpy">Setup Payment</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Master">
                                <input type="checkbox" id="sttkt" name="sttkt" value="sttkt" class="form-check-input">
                                <label for="sttkt">Setup Ticket</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Master">
                                <input type="checkbox" id="stpkt" name="stpkt" value="stpkt" class="form-check-input">
                                <label for="stpkt">Setup Paket</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Master">
                                <input type="checkbox" id="tpa" name="tpa" value="tpa" class="form-check-input">
                                <label for="tpa">Ticket per Agent</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded"
                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Master">
                                <input type="checkbox" id="ppa" name="ppa" value="ppa" class="form-check-input">
                                <label for="ppa">Paket per Agent</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Transaction">
                                <input type="checkbox" id="bootkt" name="bootkt" value="bootkt" class="form-check-input">
                                <label for="bootkt">Booking Ticket</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Transaction">
                                <input type="checkbox" id="boopkt" name="boopkt" value="boopkt" class="form-check-input">
                                <label for="boopkt">Booking Paket</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Report ">
                                <input type="checkbox" id="depto" name="depto" value="depto" class="form-check-input">
                                <label for="depto">Departure Today</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Report">
                                <input type="checkbox" id="pentkt" name="pentkt" value="pentkt" class="form-check-input">
                                <label for="pentkt">Pendapatan Ticket</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Report">
                                <input type="checkbox" id="penpkt" name="penpkt" value="penpkt" class="form-check-input">
                                <label for="penpkt">Pendapatan Paket</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Report">
                                <input type="checkbox" id="ttpa" name="ttpa" value="ttpa" class="form-check-input">
                                <label for="ttpa">Transaksi Ticket per Agent</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Report">
                                <input type="checkbox" id="tppa" name="tppa" value="tppa" class="form-check-input">
                                <label for="tppa">Transaksi Paket per Agent</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Report">
                                <input type="checkbox" id="rkt" name="rkt" value="rkt" class="form-check-input">
                                <label for="rkt">Rekap Komisi Ticket</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Report">
                                <input type="checkbox" id="rkp" name="rkp" value="rkp" class="form-check-input">
                                <label for="rkp">Rekap Komisi Paket</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Report">
                                <input type="checkbox" id="rabul" name="rabul" value="rabul" class="form-check-input">
                                <label for="rabul">Rangkuman Bulanan</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Daftar</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->

