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
                    <h5 class="card-title fw-semibold mb-4">Edit Ticket</h5>
                    <form action="<?= base_url()?>ticket/edit_process" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" name="id_edit" value="<?= $ticket->id?>">
                        <div class="mb-3">
                            <label for="tujuan" class="form-label">Tujuan</label>
                            <select name="tujuan" id="tujuan" class="form-select">
                                <option value="Sanur-Lembongan" <?=($ticket->tujuan=="Sanur-Lembongan")?"selected":""?>>Sanur - Lembongan</option>
                                <option value="Lembongan-Sanur"  <?=($ticket->tujuan=="Lembongan-Sanur")?"selected":""?>>Lembongan - Sanur</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jam_keberangkatan" class="form-label">Jam Keberangkatan</label>
                            <input type="text" class="form-control jam_keberangkatan" id="jam_keberangkatan" name="jam_keberangkatan" value="<?= $ticket->berangkat?>">
                        </div>

                        <!-- <div class="mb-3">
                            <label for="harga" class="form-label ">Harga</label>
                            <input type="text" class="form-control money-input" id="harga" name="harga" >
                        </div> -->
                        <button type="submit" class="btn btn-primary mt-3">Update Ticket</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->