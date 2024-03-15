<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row d-flex justify-content-end align-items-end form-group mb-3">
                        <div class="col-4">
                            <label class="text-start d-block mb-2">Date</label>
                            <input type="text" id="tanggal" name="tanggal" class="form-control" value="<?=date("m/d/Y")?>" autocomplete="off">
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col text-end">
                            <button id="lihat" class="btn btn-info">
                                <i class="ti ti-filter fs-5 me-1"></i>
                                Filter
                            </button>
                        </div>
                    </div>
                    <h5 class="card-title fw-semibold mb-4">List Booking Ticket</h5>
                    <table id="table_list_booking_ticket" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Ticket</th>
                                <th>Date Depart</th>
                                <th>Date Return</th>
                                <th width="200px">
                                    <select id="depart" class="form-select">
                                        <option value=""> -- Depart All -- </option>
                                        <?php foreach($tiket as $dt){?>
                                            <option value="<?=$dt["tujuan"]." - ".$dt["berangkat"]?>"><?=$dt["tujuan"]." - ".$dt["berangkat"]?></option>
                                        <?php }?>
                                    </select>
                                </th>
                                <th width="200px">
                                    <select id="return" class="form-select">
                                        <option value=""> -- Return All -- </option>
                                        <?php foreach($tiket as $dt){?>
                                            <option value="<?=$dt["tujuan"]." - ".$dt["berangkat"]?>"><?=$dt["tujuan"]." - ".$dt["berangkat"]?></option>
                                        <?php }?>
                                    </select>
                                </th>
								<th>Adult</th>
								<th>Child</th>
								<th>FOC</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
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


