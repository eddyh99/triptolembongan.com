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
                                <th>Check In</th>
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
                                        <button onClick="valuePrint('<?=$dt["dropoff"]?>','<?=$dt["dws"]?>','<?=$dt["anak"]?>','<?=$dt["foc"]?>')" class="btn btn-warning me-1"><i class="ti fs-5 ti-printer"></i></button>
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
                                <th>Check In</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="printTagPreview">
    <div class="d-flex justify-content-center mt-5 mb-2">
        <img class="text-center d-block img-fluid" src="<?= base_url()?>assets/img/arthamas.png" width="100mm" height="auto">
    </div>
    <span class="text-center d-block fst-italic fs-2">Jalan Matahari Terbit, Pertokoan ARCADE, No.4, Sanur, Denpasar Selatan</span>
    <hr>
    <span class="fs-2 text-center"><h1>Drop Off&emsp;&emsp;&nbsp;&ensp; : <span id="dropoff"></span></h1></span>
    <br>
    <span class="fs-2 text-center d-block">
        Adult: <span id="adult"></span>, Child: <span id="child"></span>, FOC: <span id="foc"></span>
    </span>
    <br>
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




