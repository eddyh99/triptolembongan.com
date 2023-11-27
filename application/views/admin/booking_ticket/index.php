<?php require('list_negara.php'); ?>
<!-- MAIN CONTENT START -->
<div class="container-fluid">
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
                    <h5 class="card-title fw-semibold mb-4">Booking Ticket</h5>
                    <form action="<?= base_url()?>booking/booking_tiket_proses" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="row">
                            <div class="row">
                                <div class="row">
                                    <div class="mb-4 col-12 col-md-6">
                                        <label for="kode_ticket" class="form-label">Kode Ticket</label>
                                        <div class="wrapper-kode-ticket d-flex align-items-center justify-content-between">
                                            <input type="text" class="fw-bold fs-5 text-success border-0" id="kode_ticket" name="kode_ticket" readonly 
                                                value="TIX<?php $num = mt_rand(100000,999999); printf("%d", $num);?>"/>
                                            <i class="ti ti-ticket fs-6 text-success"></i>
                                        </div>
                                    </div>
                                    <div class="mb-4 col-12 col-md-6 ">
                                        <label for="freecharge" class="form-label">Pilih Agen</label>
                                        <select class="agent-select2" id="nama_agent" name="nama_agent" required>
                                            <option value="undefined"></option>
                                            <?php foreach($agent as $ag){?>
                                                <option value="<?= $ag['id']?>"><?= $ag['nama']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tujuan & Tanggal Keberangkatan -->
                            <div class="row">
                                <div class="row">
                                    <div class="mb-4 col-12 col-md-6 ">
                                        <label for="freecharge" class="form-label">Tujuan</label>
                                        <div class="d-flex ">
                                            <div class="form-check">
                                                <input class="form-check-input cursor-pointer" type="radio" name="tipetujuan" id="onewayradio" value="One Way" >
                                                <label class="form-check-label cursor-pointer" for="onewayradio">
                                                    One Way
                                                </label>
                                            </div>
                                            <div class="form-check ms-3">
                                                <input class="form-check-input cursor-pointer" type="radio" name="tipetujuan" id="returnradio" value="Return" checked="checked">
                                                <label class="form-check-label cursor-pointer" for="returnradio">
                                                    Return
                                                </label>
                                            </div>
                                        </div>
        
                                        <div class="mt-3">
                                            <select id="depart_select2" class="depart-select2" name="depart" required>
                                                <option ></option>
                                                <!-- <?php foreach($ticket as $tk){?>
                                                    <option value="<?= $tk['id']?>"><?= $tk['tujuan']?> || <?= $tk['berangkat']?></option>
                                                <?php }?> -->
               
                                            </select>
                                        </div>
        
                                        <div class="mt-3">
                                            <select id="return_select2" class="return-select2" name="return_from" required>
                                                <option></option>
                                                <!-- <?php foreach($ticket as $tk){?>
                                                    <option value="<?= $tk['id']?>"><?= $tk['tujuan']?> || <?= $tk['berangkat']?></option>
                                                <?php }?> -->
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Tanggal Keberangkatan | Kembalii -->
                                    <div class="mb-4 mt-3 col-12 col-md-6 ">
                                        <div>
                                            <label for="tglberangkat" class="form-label">Tanggal Keberangkatan</label>
                                            <div class="form-control d-flex">
                                                <input type="text" class="w-100 border-0 cursor-pointer" name="tglberangkat" id="tglberangkat" autocomplete="off" required>
                                                <label for="tglberangkat" class="cursor-pointer">
                                                    <i class="ti ti-calendar-event fs-6"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label for="tglkembali" class="form-label">Tanggal Kembali</label>
                                            <div class="form-control d-flex">
                                                <input type="text" class="w-100 border-0 cursor-pointer" name="tglkembali" id="tglkembali" autocomplete="off" required>
                                                <label for="tglkembali" class="cursor-pointer">
                                                    <i class="ti ti-calendar-event fs-6"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <!-- DEWASA -->
                            <div class="row wraping-add-booking-dewasa">
                                <div class="row">
                                    <h4 class="fw-bolder text-decoration-underline">Dewasa</h4>
                                    <div class="mb-4 col-12 col-md-6 wrap-nama-tamu">
                                        <label for="nama_tamu_dewasa" class="form-label">Nama Tamu</label>
                                        <div class="d-flex align-items-center">
                                            <select id="nama_tamu_dewasa" class="nama-tamu-select2" name="nama_tamu_dewasa[]" required>
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-4 col-12 col-md-5 wrap-nasionality">
                                        <label for="nasionality-select2" class="form-label">Nasionality</label>
                                        <select name="nasionality_dewasa[]" id="nasionality-dewasa-select2" class="nasionality-select2">
                                            <option value=""></option>
                                            <?php foreach($list_negara as $dt){?>
                                                <option value="<?= $dt['name']?>"><?= $dt['name']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-center">
                                        <i class="ti ti-circle-plus add-nama-tamu-dewasa fs-8" style="cursor: pointer;"></i>
                                    </div>
                                </div>
                            </div>
    
                            <hr>

                            <!-- ANAK -->
                            <div class="row wraping-add-booking-anak">
                                <div class="row">
                                    <h4 class="fw-bolder text-decoration-underline">Anak-anak</h4>
                                    <div class="mb-4 col-12 col-md-6 wrap-nama-tamu">
                                        <label for="nama_tamu_anak" class="form-label">Nama Tamu</label>
                                        <div class="d-flex align-items-center">
                                            <select id="nama_tamu_anak" class="nama-tamu-select2" name="nama_tamu_anak[]">
                                                <option></option>
                                            </select>
                                            <!-- <input type="text" class="form-control" id="nama_tamu_anak" name="nama_tamu_anak[]" placeholder="masukkan nama tamu..."> -->
                                        </div>
                                    </div>
                                    <div class="mb-4 col-12 col-md-5 wrap-nasionality">
                                        <label for="nasionality" class="form-label">Nasionality</label>
                                        <select name="nasionality_anak[]" id="nasionality-anak-select2" class="nasionality-select2">
                                            <option value=""></option>
                                            <?php foreach($list_negara as $dt){?>
                                                <option value="<?= $dt['name']?>"><?= $dt['name']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-center">
                                        <i class="ti ti-circle-plus add-nama-tamu-anak fs-8" style="cursor: pointer;"></i>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- FOC -->
                            <div class="row wraping-add-booking-foc mb-3">
                                <div class="row">
                                    <h4 class="fw-bolder text-decoration-underline">Free of Charge</h4>
                                    <div class="mb-4 col-12 col-md-6 wrap-nama-tamu">
                                        <label for="nama_tamu_foc" class="form-label">Nama Tamu</label>
                                        <div class="d-flex align-items-center">
                                            <select id="nama_tamu_foc" class="nama-tamu-select2" name="nama_tamu_foc[]">
                                                <option></option>
                                            </select>
                                            <!-- <input type="text" class="form-control" id="nama_tamu_foc" name="nama_tamu_foc[]" placeholder="masukkan nama tamu..."> -->
                                        </div>
                                    </div>
                                    <div class="mb-4 col-12 col-md-5 wrap-nasionality">
                                        <label for="nasionality" class="form-label">Nasionality</label>
                                        <select name="nasionality_foc[]" id="nasionality-foc-select2" class="nasionality-select2">
                                            <option value=""></option>
                                            <?php foreach($list_negara as $dt){?>
                                                <option value="<?= $dt['name']?>"><?= $dt['name']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-center">
                                        <i class="ti ti-circle-plus add-nama-tamu-foc fs-8" style="cursor: pointer;"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="row">
                                    <div class="mb-4 col-12 col-md-4">
                                        <label for="pickup" class="form-label">Pickup</label>
                                        <input type="text" class="form-control" id="pickup" name="pickup" placeholder="masukkan pickup dimana..." autocomplete="off" maxlength="45" required>
                                    </div>
        
                                    <div class="mb-4 col-12 col-md-4 ">
                                        <label for="dropoff" class="form-label">Drop off</label>
                                        <input type="text" class="form-control" id="dropoff" name="dropoff" placeholder="masukkan drop off dimana..." autocomplete="off" maxlength="45" required>
                                    </div>
        
                                    <div class="mb-4 col-12 col-md-4 ">
                                        <label for="catatan" class="form-label">Remarks</label>
                                        <input type="text" class="form-control" id="catatan" name="catatan" placeholder="masukkan catatan tamu..." autocomplete="off" maxlength="45" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row">
                                <div class="col-4">
                                    <label for="payment" class="form-label">Payment</label>
                                    <select name="payment" id="payment" class="form-select">
                                        <?php foreach ($payment as $dt){?>
                                            <option value="<?=$dt["id"]?>"><?=$dt["payment"]?></option>
                                        <?php }?>
                                    </select>
                                    <button id="cekHarga" class="btn btn-dark mt-3">Cek Harga</button>
                                    <button type="submit" class="btn btn-primary mt-3">Booking Sekarang</button>
                                </div>
                                <div class="col-8">
                                    <div class="mb-4 col-12">
                                        <div class="col-12 d-flex align-items-strech">
                                            <div class="card w-100">
                                                <div class="card-body p-4">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <h5 class="card-title fw-semibold">Summary Booking Ticket</h5>
                                                        <p class="card-subtitle mb-2">
                                                            Agen: <span class="fw-bolder display-nama-agent">-</span>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="card-subtitle mb-2">
                                                            Keberangkatan: <span class="display-tgl-berangkat">-</span>
                                                        </p>
                                                        <p class="card-subtitle mb-2">
                                                            Kembali: <span class="display-tgl-kembali">-</span>
                                                        </p>
                                                    </div>

                                                </div>
                                                <div class="card shadow-none mt-1 mb-0">
                                                    <div class="d-flex align-items-center gap-3 py-3">
                                                        <div>
                                                            <h6 class="mb-0 fw-semibold">
                                                                Tujuan: <span class="display-tujuan">-</span>
                                                            </h6>
                                                            <span class="fs-2">
                                                                Depart: <span class="display-depart">-</span>
                                                            </span>
                                                            <br>
                                                            <span class="fs-2">
                                                                Return: <span class="display-return">-</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-3 py-3 border-bottom">
                                                        <div>
                                                            <h6 class="mb-0 fw-semibold">Dewasa</h6>
                                                            <span class="fs-2">
                                                                <span class="display-dewasa-jumlah">0</span> Orang
                                                            </span>
                                                        </div>
                                                        <div class="ms-auto text-end">
                                                            <span class="fs-2">Total Dewasa</span>
                                                            <h6 class="mb-0 fw-semibold">
                                                                Rp.<span class="display-total-harga-dewasa">0</span>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-3 py-3 border-bottom">
                                                        <div>
                                                            <h6 class="mb-0 fw-semibold">Anak - Anak</h6>
                                                            <span class="fs-2">
                                                                <span class="display-anak-jumlah">0</span> Orang
                                                            </span>
                                                        </div>
                                                        <div class="ms-auto text-end">
                                                            <span class="fs-2">Total Anak - Anak</span>
                                                            <h6 class="mb-0 fw-semibold">
                                                                Rp.<span class="display-total-harga-anak">0</span>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-3 py-3 border-bottom">
                                                        <div>
                                                            <h6 class="mb-0 fw-semibold">Free of Charge</h6>
                                                            <span class="fs-2">
                                                                <span class="display-foc-jumlah">0</span> Orang    
                                                            </span>
                                                        </div>
                                                        <div class="ms-auto text-end">
                                                            <span class="fs-2">Total Free of Charge</span>
                                                            <h6 class="mb-0 fw-semibold">
                                                                Rp.<span class="display-total-harga-foc">0</span>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-3 py-3">
                                                        <div>
                                                            <h6 class="mb-0 fw-semibold">Total Keseluruhan</h6>
                                                            <!-- <span class="fs-2">2 Orang</span> -->
                                                        </div>
                                                        <div class="ms-auto text-end">
                                                            <!-- <span class="fs-2">Rp.2.200,000</span> -->
                                                            <h6 class="mb-0 fw-semibold">
                                                                Rp.<span class="display-total-harga-final">0</span>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <button id="cekHarga" class="btn btn-dark mt-3">CEK HARGA</button> -->
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->


