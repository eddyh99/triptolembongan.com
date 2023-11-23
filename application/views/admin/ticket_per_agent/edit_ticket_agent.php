<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>ticket/ticket_agent" class="btn btn-outline-primary d-flex align-items-center">
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
                    <h5 class="card-title fw-semibold mb-4">Edit Ticket per Agent</h5>
                    <form action="<?= base_url()?>ticket/tambah_ticket_agent_process" method="POST">
                        <div class="row">
                            <div class="mb-4 col-6">
                                <label for="berlaku" class="form-label">Nama Agent</label>
                                <select class="nama-agent" name="id_agent">
                                    <option value="<?= $tiket_agent['0']['id_nama']?>"><?= $tiket_agent['0']['nama']?></option>
                                </select>
                            </div>
                            <div class="mb-4 col-6">
                            <label for="berlaku" class="form-label">Ticket Agent</label>
                                <select class="ticket" name="id_ticket">
                                <option value="<?= $tiket_agent['0']['id']?>"><?= $tiket_agent['0']['tujuan'] ?> | <?= $tiket_agent['0']['berangkat'] ?></option>
                                </select>
                            </div>
                          
                            <div class="mb-3 col-6">
                                <label for="harga" class="form-label ">Harga</label>
                                <input type="text" class="form-control money-input" id="harga" name="harga" >
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Edit Ticket</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->
