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
                    <h5 class="card-title fw-semibold mb-4">Booking Paket</h5>
                    <form action="<?= base_url()?>booking/booking_paket_proses" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="row">
                            <div class="row">
                                <div class="row">
                                    <div class="mb-4 col-12 col-md-6">
                                        <label for="kode_ticket" class="form-label">Code Ticket</label>
                                        <div class="wrapper-kode-ticket d-flex align-items-center justify-content-between">
                                            <input type="text" class="fw-bold fs-5 text-success border-0" id="kode_ticket" name="kode_ticket" readonly 
                                                value="<?= $booking_paket->kode_tiket?>"/>
                                            <i class="ti ti-ticket fs-6 text-success"></i>
                                        </div>
                                    </div>
                                    <div class="mb-4 col-12 col-md-6 ">
                                        <label for="freecharge" class="form-label">Select Agent</label>
                                        <select class="agent-select2" id="nama_agent" name="nama_agent" required>
                                            <option value="undefined"></option>
                                            <?php foreach($agent as $ag){?>
                                                <option value="<?= $ag['id']?>" <?=($booking_paket->agentid == $ag['id']) ? "selected" : "" ?> > <?= $ag['nama']?> </option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tujuan & Tanggal Keberangkatan -->
                            <div class="row">
                                <div class="row">
                                    <div class="mb-4 col-12 col-md-4 ">
                                        <label for="paket-select2" class="form-label">Select Paket</label>
                                        <select name="paket" id="paket_select2" class="paket-select2">
                                            <option></option>
                                        </select>
                                    </div>

                                    <div class="mb-4 col-12 col-md-4 ">
                                        <div>
                                            <label for="tglberangkat" class="form-label">Date Depart</label>
                                            <div class="form-control d-flex">
                                                <input type="text" class="w-100 border-0 cursor-pointer" name="tglberangkat" id="tglberangkat" autocomplete="off" value="<?= date("d-m-Y", strtotime($booking_paket->berangkat));?>" required>
                                                <label for="tglberangkat" class="cursor-pointer">
                                                    <i class="ti ti-calendar-event fs-6"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tanggal Keberangkatan | Kembalii -->
                                    <div class="mb-4 col-12 col-md-4 ">
                                        <div class="">
                                            <label for="tglkembali" class="form-label">Date Return</label>
                                            <div class="form-control d-flex">
                                                <input type="text" class="w-100 border-0 cursor-pointer" name="tglkembali" id="tglkembali" autocomplete="off" value="<?= date("d-m-Y", strtotime($booking_paket->kembali));?>" required>
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
                                    <h4 class="fw-bolder text-decoration-underline">Adult</h4>
                                    <div class="mb-4 col-12 col-md-3 wrap-nama-tamu">
                                        <label for="nama_tamu_dewasa" class="form-label">Guest Name</label>
                                        <div class="d-flex align-items-center">
                                            <?php  
                                                foreach($booking_detail as $dt){
                                                    if($dt['jenis'] == 'dewasa'){
                                                
                                            ?>
                                                <select class="nama-tamu-select2" name="nama_tamu_dewasa[]">
                                                    <option value="<?= $dt['namatamu']?>"><?= $dt['namatamu']?></option>
                                                </select>
                                            <?php 
                                                break;
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="mb-4 col-12 col-md-3 wrap-nasionality">
                                        <label for="nasionality-select2" class="form-label">Nasionality</label>
                                        <?php  
                                            foreach($booking_detail as $dt){
                                                if($dt['jenis'] == 'dewasa'){
                                            
                                        ?>
                                            <select class="nasionality-select2" name="nasionality_dewasa[]" required>
                                                <option value="<?= $dt['nasionality']?>" selected><?= $dt['nasionality']?></option>
                                                <?php foreach($list_negara as $ln){
                                                    if($ln['name'] != $dt['nasionality']){
                                                ?>
                                                        
                                                    <option value="<?= $ln['name']?>"><?= $ln['name']?></option>
                                                <?php }
                                                    }
                                                ?>
                                            </select>
                                        <?php 
                                            break;
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="mb-4 col-12 col-md-3 wrap-nama-tamu">
                                        <label for="nohp_tamu_dewasa" class="form-label">No Hp/WA</label>
                                        <div class="d-flex align-items-center">
                                            <?php  
                                                foreach($booking_detail as $dt){
                                                    if($dt['jenis'] == 'dewasa'){
                                                
                                            ?>
                                                <select class="nohp-tamu-select2" name="nohp_tamu_dewasa[]">
                                                    <option value="<?= $dt['nope']?>"><?= $dt['nope']?></option>
                                                </select>
                                            <?php 
                                                break;
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="mb-4 col-12 col-md-2 wrap-nama-tamu">
                                        <label for="email_tamu_dewasa" class="form-label">Email</label>
                                        <div class="d-flex align-items-center">
                                            <?php  
                                                foreach($booking_detail as $dt){
                                                    if($dt['jenis'] == 'dewasa'){
                                                
                                            ?>
                                                <select class="email-tamu-select2" name="email_tamu_dewasa[]">
                                                    <option value="<?= $dt['email']?>"><?= $dt['email']?></option>
                                                </select>
                                            <?php 
                                                break;
                                                    }
                                                }
                                            ?>
                                        </div>
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
                                    <h4 class="fw-bolder text-decoration-underline">Child</h4>
                                    <div class="mb-4 col-12 col-md-3 wrap-nama-tamu">
                                        <label for="nama_tamu_anak" class="form-label">Guest Name</label>
                                        <div class="d-flex align-items-center">
                                            <?php  
                                                foreach($booking_detail as $dt){
                                                    if($dt['jenis'] == 'anak'){
                                                
                                            ?>
                                                <select class="nama-tamu-select2" name="nama_tamu_anak[]">
                                                    <option value="<?= $dt['namatamu']?>"><?= $dt['namatamu']?></option>
                                                </select>
                                            <?php 
                                                break;
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="mb-4 col-12 col-md-3 wrap-nasionality">
                                        <label for="nasionality" class="form-label">Nasionality</label>
                                        <?php  
                                            foreach($booking_detail as $dt){
                                                if($dt['jenis'] == 'anak'){
                                            
                                        ?>
                                            <select class="nasionality-select2" name="nasionality_anak[]" required>
                                                <option value="<?= $dt['nasionality']?>" selected><?= $dt['nasionality']?></option>
                                                <?php foreach($list_negara as $ln){
                                                    if($ln['name'] != $dt['nasionality']){
                                                ?>
                                                        
                                                    <option value="<?= $ln['name']?>"><?= $ln['name']?></option>
                                                <?php }
                                                    }
                                                ?>
                                            </select>
                                        <?php 
                                            break;
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="mb-4 col-12 col-md-3 wrap-nama-tamu">
                                        <label for="nohp_tamu_anak" class="form-label">No Hp/WA</label>
                                        <div class="d-flex align-items-center">
                                            <?php  
                                                foreach($booking_detail as $dt){
                                                    if($dt['jenis'] == 'anak'){
                                                
                                            ?>
                                                <select class="nohp-tamu-select2" name="nohp_tamu_anak[]">
                                                    <option value="<?= $dt['nope']?>"><?= $dt['nope']?></option>
                                                </select>
                                            <?php 
                                                break;
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="mb-4 col-12 col-md-2 wrap-nama-tamu">
                                        <label for="email_tamu_anak" class="form-label">Email</label>
                                        <div class="d-flex align-items-center">
                                            <?php  
                                                foreach($booking_detail as $dt){
                                                    if($dt['jenis'] == 'anak'){
                                                
                                            ?>
                                                <select class="email-tamu-select2" name="email_tamu_anak[]">
                                                    <option value="<?= $dt['email']?>"><?= $dt['email']?></option>
                                                </select>
                                            <?php 
                                                break;
                                                    }
                                                }
                                            ?>
                                        </div>
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
                                    <div class="mb-4 col-12 col-md-3 wrap-nama-tamu">
                                        <label for="nama_tamu_foc" class="form-label">Guest Name</label>
                                        <div class="d-flex align-items-center">
                                            <?php  
                                                foreach($booking_detail as $dt){
                                                    if($dt['jenis'] == 'foc'){
                                                
                                            ?>
                                                <select class="nama-tamu-select2" name="nama_tamu_foc[]">
                                                    <option value="<?= $dt['namatamu']?>"><?= $dt['namatamu']?></option>
                                                </select>
                                            <?php 
                                                break;
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="mb-4 col-12 col-md-3 wrap-nasionality">
                                        <label for="nasionality" class="form-label">Nasionality</label>
                                        <?php  
                                            foreach($booking_detail as $dt){
                                                if($dt['jenis'] == 'foc'){
                                            
                                        ?>
                                            <select class="nasionality-select2" name="nasionality_foc[]" required>
                                                <option value="<?= $dt['nasionality']?>" selected><?= $dt['nasionality']?></option>
                                                <?php foreach($list_negara as $ln){
                                                    if($ln['name'] != $dt['nasionality']){
                                                ?>
                                                        
                                                    <option value="<?= $ln['name']?>"><?= $ln['name']?></option>
                                                <?php }
                                                    }
                                                ?>
                                            </select>
                                        <?php 
                                            break;
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="mb-4 col-12 col-md-3 wrap-nama-tamu">
                                        <label for="nohp_tamu_foc" class="form-label">No Hp/WA</label>
                                        <div class="d-flex align-items-center">
                                            <?php  
                                                foreach($booking_detail as $dt){
                                                    if($dt['jenis'] == 'foc'){
                                                
                                            ?>
                                                <select class="nohp-tamu-select2" name="nohp_tamu_foc[]">
                                                    <option value="<?= $dt['nope']?>"><?= $dt['nope']?></option>
                                                </select>
                                            <?php 
                                                break;
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="mb-4 col-12 col-md-2 wrap-nama-tamu">
                                        <label for="email_tamu_foc" class="form-label">Email</label>
                                        <div class="d-flex align-items-center">
                                            <?php  
                                                foreach($booking_detail as $dt){
                                                    if($dt['jenis'] == 'foc'){
                                                
                                            ?>
                                                <select class="email-tamu-select2" name="email_tamu_foc[]">
                                                    <option value="<?= $dt['email']?>"><?= $dt['email']?></option>
                                                </select>
                                            <?php 
                                                break;
                                                    }
                                                }
                                            ?>
                                        </div>
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
                                        <input type="text" class="form-control" id="pickup" name="pickup" value="<?= $booking_paket->pickup?>"  placeholder="Enter Pickup..." autocomplete="off" maxlength="45" required>
                                    </div>
        
                                    <div class="mb-4 col-12 col-md-4 ">
                                        <label for="dropoff" class="form-label">Drop off</label>
                                        <input type="text" class="form-control" id="dropoff" name="dropoff" value="<?= $booking_paket->dropoff?>" placeholder="Enter Drop Off..." autocomplete="off" maxlength="45" required>
                                    </div>
        
                                    <div class="mb-4 col-12 col-md-4 ">
                                        <label for="catatan" class="form-label">Remarks</label>
                                        <input type="text" class="form-control" id="catatan" name="catatan" value="<?= $booking_paket->remarks?>" placeholder="Enter Remarks..." autocomplete="off" maxlength="45">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row">
                                <div class="col-4">
                                <label for="payment" class="form-label">Select Payment</label>
                                    <select name="payment" id="payment" class="form-select">
                                        <?php foreach ($payment as $dt){?>
                                            <option value="<?=$dt["id"]?>" <?=($booking_paket->payment == $dt['id']) ? "selected" : "" ?> ><?=$dt["payment"]?></option>
                                        <?php }?>
                                    </select>

                                    <button id="cekHarga" class="btn btn-dark mt-3">Check Summary</button>
                                    <button type="submit" class="btn btn-primary mt-3">Booking Now</button>
                                </div>
                                <div class="col-8">
                                    <div class="mb-4 col-12">
                                        <div class="col-12 d-flex align-items-strech">
                                            <div class="card w-100">
                                                <div class="card-body p-4">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <h5 class="card-title fw-semibold">Summary Booking Paket</h5>
                                                        <p class="card-subtitle mb-2">
                                                            Agent: <span class="fw-bolder display-nama-agent">-</span>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="card-subtitle mb-2">
                                                            Depart: <span class="display-tgl-berangkat">-</span>
                                                        </p>
                                                        <p class="card-subtitle mb-2">
                                                            Return: <span class="display-tgl-kembali">-</span>
                                                        </p>
                                                    </div>

                                                </div>
                                                <div class="card shadow-none mt-1 mb-0">
                                                    <div class="d-flex align-items-center gap-3 py-3">
                                                        <div>
                                                            <h6 class="mb-0 fw-semibold">Paket: 
                                                                <span class="display-namapaket"></span>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-3 py-3 border-bottom">
                                                        <div>
                                                            <h6 class="mb-0 fw-semibold">Adult</h6>
                                                            <span class="fs-2">
                                                                <span class="display-dewasa-jumlah">0</span> Person
                                                            </span>
                                                        </div>
                                                        <div class="ms-auto text-end">
                                                            <!-- <span class="fs-2">Total Dewasa</span>
                                                            <h6 class="mb-0 fw-semibold">
                                                                Rp.<span class="display-total-harga-dewasa">0</span>
                                                            </h6> -->
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-3 py-3 border-bottom">
                                                        <div>
                                                            <h6 class="mb-0 fw-semibold">Child</h6>
                                                            <span class="fs-2">
                                                                <span class="display-anak-jumlah">0</span> Person
                                                            </span>
                                                        </div>
                                                        <div class="ms-auto text-end">
                                                            <!-- <span class="fs-2">Total Anak - Anak</span>
                                                            <h6 class="mb-0 fw-semibold">
                                                                Rp.<span class="display-total-harga-anak">0</span>
                                                            </h6> -->
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-3 py-3 border-bottom">
                                                        <div>
                                                            <h6 class="mb-0 fw-semibold">Free of Charge</h6>
                                                            <span class="fs-2">
                                                                <span class="display-foc-jumlah">0</span> Person    
                                                            </span>
                                                        </div>
                                                        <div class="ms-auto text-end">
                                                            <!-- <span class="fs-2">Total Free of Charge</span>
                                                            <h6 class="mb-0 fw-semibold">
                                                                Rp.<span class="display-total-harga-foc">0</span>
                                                            </h6> -->
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-3 py-3">
                                                        <div>
                                                            <h6 class="mb-0 fw-semibold">Total</h6>
                                                        </div>
                                                        <div class="ms-auto text-end">
                                                            <!-- <span class="fs-2">Rp.2.200,000</span> -->
                                                            <h6 class="mb-0 fw-semibold d-flex align-items-center">
                                                                <span>Rp.</span>
                                                                <span class="display-total-harga-final">
                                                                    <input type="text" class="form-control money-input input-total-rangkuman" name="total" required>
                                                                </span>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <div id="komisigeneral" class="d-none align-items-center gap-3 py-3">
                                                        <div>
                                                            <h6 class="mb-0 fw-semibold">Commission</h6>
                                                        </div>
                                                        <div class="ms-auto text-end">
                                                            <h6 class="mb-0 fw-semibold d-flex align-items-center">
                                                                <span>Rp.</span>
                                                                <span class="display-total-harga-final">
                                                                    <input type="text" class="form-control money-input input-total-rangkuman" name="komisi">
                                                                </span>
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
