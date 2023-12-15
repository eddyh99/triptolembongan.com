<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <!--  Row Departure Today -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Departure Today</h5>
                    <table id="table_list_booking_paket" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Guest</th>
                                <th>Total</th>
                                <th>Depart</th>
                                <th>Chekin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $dt){?>
                                <tr>
                                    <td><?= $dt['kode_tiket']?></td>
                                    <td><?= $dt['namatamu']?></td>
                                    <td>
                                        <?php 
                                            $total = $dt['dws'] + $dt['anak'] + $dt['foc'];
                                            echo $total;
                                        ?>
                                    </td>
                                    <td><?= $dt['depart']?></td>
                                    <td>
                                        <?php if(empty($dt['checkin_by'])){?>
                                            <a href="<?= base_url()?>departure/checkin/<?= base64_encode($dt['id'])?>" class="btn btn-warning"><i class="ti ti-clock-edit fs-6"></i></a>
                                        <?php } else {?>
                                            <button disabled class="btn btn-success"><i class="ti ti-check"></i></button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Code</th>
                                <th>Guest</th>
                                <th>Total</th>
                                <th>Depart</th>
                                <th>Chekin</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

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




