<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>user" class="btn btn-outline-primary d-flex align-items-center">
                
                <i class="ti ti-chevron-left fs-5 me-2"></i>
                <span>
                    Back
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
                    <h5 class="card-title fw-semibold mb-4">Edit User</h5>
                    <form action="<?= base_url()?>user/edit_process" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="mb-3">
                            <label for="nama_agent" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $user->username?>" placeholder="Enter Usernmae..." required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Password</label>
                            <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Enter password...">
                            <small class="text-danger">*leave blank if you don't want to change the password</small>
                        </div>
                        <div class="mb-3 col-3">
                            <label for="role" class="form-label">Location</label>
                            <select name="lokasi" id="lokasi" class="form-select">
                                <option value="Sanur" <?php echo ($user->lokasi=="Sanur")?"selected":"" ?>>Sanur</option>
                                <option value="Lembongan" <?php echo ($user->lokasi=="Lembongan")?"selected":"" ?>>Lembongan</option>
                            </select>
                        </div>
                        <div class="col-12 d-flex">
                            <label class="form-label">Menu Checklist</label>
                        </div>
                        <div class="col-12 d-flex flex-wrap">
                            <div class="border border-primary mx-2 p-2 roun mt-2 rounded"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Master">
                                <input type="checkbox" id="stu" name="stu" value="stu" class="form-check-input" <?= ($get_role['stu'] == 'stu') ? checked : ''?>>
                                <label for="stu">Setup User</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Master">
                                <input type="checkbox" id="stag" name="stag" value="stag" class="form-check-input" <?= ($get_role['stag'] == 'stag') ? checked : ''?>>
                                <label for="stag">Setup Agent</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Master">
                                <input type="checkbox" id="stpy" name="stpy" value="stpy" class="form-check-input" <?= ($get_role['stpy'] == 'stpy') ? checked : ''?>>
                                <label for="stpy">Setup Payment</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Master">
                                <input type="checkbox" id="sttkt" name="sttkt" value="sttkt" class="form-check-input" <?= ($get_role['sttkt'] == 'sttkt') ? checked : ''?>>
                                <label for="sttkt">Departure Schedule</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Master">
                                <input type="checkbox" id="stpkt" name="stpkt" value="stpkt" class="form-check-input" <?= ($get_role['stpkt'] == 'stpkt') ? checked : ''?>>
                                <label for="stpkt">Setup Paket</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Master">
                                <input type="checkbox" id="tpag" name="tpag" value="tpag" class="form-check-input" <?= ($get_role['tpag'] == 'tpag') ? checked : ''?>>
                                <label for="tpag">Ticket per Agent</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded"
                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Master">
                                <input type="checkbox" id="ppag" name="ppag" value="ppag" class="form-check-input" <?= ($get_role['ppag'] == 'ppag') ? checked : ''?>>
                                <label for="ppag">Paket per Agent</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Transaction">
                                <input type="checkbox" id="bootk" name="bootk" value="bootk" class="form-check-input" <?= ($get_role['bootk'] == 'bootk') ? checked : ''?>>
                                <label for="bootk">Booking Ticket</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Transaction">
                                <input type="checkbox" id="boopk" name="boopk" value="boopk" class="form-check-input" <?= ($get_role['boopk'] == 'boopk') ? checked : ''?>>
                                <label for="boopk">Booking Paket</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Report ">
                                <input type="checkbox" id="depto" name="depto" value="depto" class="form-check-input" <?= ($get_role['depto'] == 'depto') ? checked : ''?>>
                                <label for="depto">Departure Today</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Report">
                                <input type="checkbox" id="pentk" name="pentk" value="pentk" class="form-check-input" <?= ($get_role['pentk'] == 'pentk') ? checked : ''?>>
                                <label for="pentk">Pendapatan Ticket</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Report">
                                <input type="checkbox" id="penpk" name="penpk" value="penpk" class="form-check-input" <?= ($get_role['penpk'] == 'penpk') ? checked : ''?>>
                                <label for="penpk">Pendapatan Paket</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Report">
                                <input type="checkbox" id="ttpa" name="ttpa" value="ttpa" class="form-check-input" <?= ($get_role['ttpa'] == 'ttpa') ? checked : ''?>>
                                <label for="ttpa">Transaksi Ticket per Agent</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Report">
                                <input type="checkbox" id="tppa" name="tppa" value="tppa" class="form-check-input" <?= ($get_role['tppa'] == 'tppa') ? checked : ''?>>
                                <label for="tppa">Transaksi Paket per Agent</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Report">
                                <input type="checkbox" id="rkt" name="rkt" value="rkt" class="form-check-input" <?= ($get_role['rkt'] == 'rkt') ? checked : ''?>>
                                <label for="rkt">Rekap Komisi Ticket</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Report">
                                <input type="checkbox" id="rkp" name="rkp" value="rkp" class="form-check-input" <?= ($get_role['rkp'] == 'rkp') ? checked : ''?>>
                                <label for="rkp">Rekap Komisi Paket</label>
                            </div>
                            <div class="border border-primary p-2 mx-2 mt-2 rounded" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Report">
                                <input type="checkbox" id="rabul" name="rabul" value="rabul" class="form-check-input" <?= ($get_role['rabul'] == 'rabul') ? checked : ''?>>
                                <label for="rabul">Rangkuman Bulanan</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->

