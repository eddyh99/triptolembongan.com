<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <!--  Row Daftar User Agent -->
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>booking" class="btn btn-primary d-flex align-items-center">
                <i class="ti ti-plus fs-5 me-2"></i>
                <span>
                    Booking Ticket
                </span>
            </a>
        </div>
    </div>
    <!--  Row List User Agent -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <form action="<?=base_url()?>booking/get_list_ticket_agent" method="post">
                        <div class="row d-flex justify-content-end align-items-end form-group mb-3">
                            <div class="col-3">
                                <label class="text-start d-block mb-2">Ticket Type</label>
                                <select name="tipeticket" class="form-select">
                                    <option>--- Choose Ticket Type ---</option>
                                    <option value="all">All</option>
                                    <option value="oneway">One Way</option>
                                    <option value="return">Return</option>
                                    <option value="open">Open</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label class="text-start d-block mb-2">Range Tanggal</label>
                                <input type="text" id="tanggal" name="tanggal" class="form-control" value="" autocomplete="off">
                            </div>
                        </div>
                        <div class="row form-group mb-3">
                            <div class="col text-end">
                                <button type="submit" class="btn btn-info">Lihat</button>
                            </div>
                        </div>
                        <h5 class="card-title fw-semibold mb-4">List Booking Ticket</h5>
                    </form>
                    <table id="table_list_booking_ticket" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Guest</th>
                                <th>Depart</th>
                                <th>Date Depart</th>
                                <th>Return</th>
                                <th>Date Return</th>
                                <th>Reserved</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Code</th>
                                <th>Guest</th>
                                <th class="th-depart-ticket">Depart</th>
                                <th>Date Depart</th>
                                <th class="th-return-ticket">Return</th>
                                <th>Date Return</th>
                                <th>Reserved</th>
                                <th>Jumlah</th>
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


