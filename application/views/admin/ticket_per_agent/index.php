<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <!--  Row Daftar User Agent -->
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>ticket/tambah_ticket_agent" class="btn btn-primary d-flex align-items-center">
                <i class="ti ti-plus fs-5 me-2"></i>
                <span>
                    Tambah Ticket per Agent
                </span>
            </a>
        </div>
    </div>
    <!--  Row List User Agent -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">List Ticket</h5>
                    <table id="table_list_ticket_agent" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tujuan</th>
                                <th>Keberangkatan</th>
                                <th>Nama Agent</th>
                                <th>No.Telp</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Tujuan</th>
                                <th>Keberangkatan</th>
                                <th>Nama Agent</th>
                                <th>No.Telp</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MAIN CONTENT END -->

<!-- SWEET ALERT START -->
<?php if(isset($_SESSION["success"])) { ?>
    <script>
        setTimeout(function() {
            Swal.fire({
                html: '<?= $_SESSION['success'] ?>',
                position: 'top',
                timer: 3000,
                showCloseButton: true,
                showConfirmButton: false,
                icon: 'success',
                timer: 2000,
                timerProgressBar: true,
            });
        }, 100);
    </script>
<?php } ?>
<!-- SWEET ALERT END -->



