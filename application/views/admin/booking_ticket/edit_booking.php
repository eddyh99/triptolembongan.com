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
                    <form action="<?= base_url()?>booking/edit_booking_ticket_proses" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" id="id_bookingticket" name="id_bookingticket" value="<?= $booking_ticket->id?>">
                        <input type="hidden" name="tgl_pesan" value="<?= $booking_ticket->tgl_pesan?>">
                        <div class="row">
                            <div class="row">
                                <div class="row">
                                    <div class="mb-4 col-12 col-md-6">
                                        <label for="kode_ticket" class="form-label">Code Ticket</label>
                                        <div class="wrapper-kode-ticket d-flex align-items-center justify-content-between">
                                            <input type="text" class="fw-bold fs-5 text-success border-0" id="kode_ticket" name="kode_ticket" readonly 
                                                value="<?= $booking_ticket->kode_tiket?>"/>
                                            <i class="ti ti-ticket fs-6 text-success"></i>
                                        </div>
                                    </div>
                                    <div class="mb-4 col-12 col-md-6 ">
                                        <label for="freecharge" class="form-label">Select Agen</label>
                                        <select class="agent-select2" id="nama_agent" name="nama_agent" required>
                                            <option value="undefined"></option>
                                            <?php foreach($agent as $ag){?>
                                                <option data-tipe="<?= $ag['tipe']?>" value="<?= $ag['id']?>" <?=($booking_ticket->agentid == $ag['id']) ? "selected" : "" ?>><?= $ag['nama']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tujuan & Tanggal Keberangkatan -->
                            <div class="row">
                                <div class="row">
                                    <div class="mb-4 col-12 col-md-6 ">
                                        <label for="freecharge" class="form-label">Type</label>
                                        <div class="d-flex ">
                                            <div class="form-check">
                                                <input class="form-check-input cursor-pointer" type="radio" name="tipetujuan" id="onewayradio" value="One Way" <?= ($booking_ticket->return_from == null && $booking_ticket->is_open == 'no') ? 'checked'  : ''?>>
                                                <label class="form-check-label cursor-pointer" for="onewayradio">
                                                    One Way
                                                </label>
                                            </div>
                                            <div class="form-check ms-3">
                                                <input class="form-check-input cursor-pointer" type="radio" name="tipetujuan" id="returnradio" value="Return" <?= ($booking_ticket->return_from != null && $booking_ticket->is_open == 'no') ? 'checked'  : ''?>>
                                                <label class="form-check-label cursor-pointer" for="returnradio">
                                                    Return
                                                </label>
                                            </div>
                                            <div class="form-check ms-3">
                                                <input class="form-check-input cursor-pointer" type="radio" name="tipetujuan" id="openradio" value="Open"  <?= ($booking_ticket->return_from == null && $booking_ticket->is_open == 'yes') ? 'checked'  : ''?>>
                                                <label class="form-check-label cursor-pointer" for="openradio">
                                                    Open
                                                </label>
                                            </div>
                                        </div>
        
                                        <div class="mt-3">
                                            <select id="depart_select2" class="depart-select2" name="depart" required>
                                                <option></option>
                                            </select>
                                        </div>
        
                                        <div class="mt-3">
                                            <select id="return_select2" class="return-select2" name="return_from" required>
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Tanggal Keberangkatan | Kembalii -->
                                    <div class="mb-4 mt-3 col-12 col-md-6 ">
                                        <div>
                                            <label for="tglberangkat" class="form-label">Date Depart</label>
                                            <div class="form-control d-flex">
                                                <input type="text" class="w-100 border-0 cursor-pointer" name="tglberangkat" id="tglberangkat" value="<?= date("d-m-Y", strtotime($booking_ticket->berangkat));?>" autocomplete="off" required>
                                                <label for="tglberangkat" class="cursor-pointer">
                                                    <i class="ti ti-calendar-event fs-6"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label for="tglkembali" class="form-label">Date Return</label>
                                            <div class="form-control d-flex">
                                                <input type="text" class="w-100 border-0 cursor-pointer" name="tglkembali" id="tglkembali" value="<?= (isset($booking_ticket->kembali)) ? date("d-m-Y", strtotime($booking_ticket->kembali)) : ''?>" autocomplete="off">
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
                                    <div class="mb-4 col-12 col-md wrap-nama-tamu">
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
                                    <div class="mb-4 col-12 col-md wrap-nasionality">
                                        <label for="nasionality-select2" class="form-label">Nasionality</label>
                                        <?php  
                                            foreach($booking_detail as $dt){
                                                if($dt['jenis'] == 'dewasa'){
                                            
                                        ?>
                                            <select class="nasionality-select2" name="nasionality_dewasa[]" required>
                                                <option value="<?= $dt['nasionality']?>"><?= $dt['nasionality']?></option>
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
                                    <div class="mb-4 col-12 col-md wrap-nama-tamu">
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
                                    <div class="mb-4 col-12 col-md wrap-nama-tamu">
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
                                    <div class="mb-4 col-12 col-md wrap-nama-tamu">
                                        <label for="jnskel_dewasa" class="form-label">Sex</label>
                                        <div class="d-flex align-items-center">
                                            <select id="jnskel_dewasa" class="form-select" name="jnskel_dewasa[]">
                                                <option value="pria" <?php echo ($dt["jenis"]=="dewasa")? ($dt["jnskel"]=="pria")?"selected":"":"" ?> >Pria</option>
                                                <option value="wanita" <?php echo ($dt["jenis"]=="dewasa")? ($dt["jnskel"]=="wanita")?"selected":"":"" ?>>Wanita</option>
                                            </select>
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
                                        <div class="d-flex align-items-center main-row-anak">
                                            <?php foreach($booking_detail as $dt){ ?>
                                                <?php if($dt['jenis'] == 'anak'){?>
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
                                        <div class="d-flex align-items-center main-row-anak">
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
                                    </div>
                                    <div class="mb-4 col-12 col-md-3 wrap-nama-tamu">
                                        <label for="nohp_tamu_anak" class="form-label">No Hp/WA</label>
                                        <div class="d-flex align-items-center main-row-anak">
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
                                        <div class="d-flex align-items-center main-row-anak">
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
                                        <i style="cursor: pointer;" id="main-anak" class="d-block col-md-1 ti ti-circle-minus fs-8 text-danger remove-add-book-dewasa"></i>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- FOC -->
                            <div class="row wraping-add-booking-foc mb-3">
                                <div class="row">
                                    <h4 class="fw-bolder text-decoration-underline">Free of Charge</h4>
                                    <div class="mb-4 col-12 col-md-3 wrap-nama-tamu">
                                        <label for="nama_tamu_foc" class="form-label">Nama Tamu</label>
                                        <div class="d-flex align-items-center main-row-foc">
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
                                        <div class="d-flex align-items-center main-row-foc">
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
                                    </div>
                                    <div class="mb-4 col-12 col-md-3 wrap-nama-tamu">
                                        <label for="nohp_tamu_foc" class="form-label">No Hp/WA</label>
                                        <div class="d-flex align-items-center main-row-foc">
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
                                        <div class="d-flex align-items-center main-row-foc">
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
                                        <i style="cursor: pointer;" id="main-foc" class="d-block col-md-1 ti ti-circle-minus fs-8 text-danger remove-add-book-dewasa"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <h2 class="text-decoration-underline">Depart</h2>
                                <div class="row">
                                    <div class="mb-4 col-12 col-md-4">
                                        <label for="pickup" class="form-label">Pickup</label>
                                        <input type="text" class="form-control" id="pickup" name="pickup" placeholder="Enter Pickup..." value="<?= $booking_ticket->pickup?>" autocomplete="off" maxlength="45" required>
                                    </div>
        
                                    <div class="mb-4 col-12 col-md-4 ">
                                        <label for="dropoff" class="form-label">Drop off</label>
                                        <input type="text" class="form-control" id="dropoff" name="dropoff" placeholder="Enter Drop Off ..." value="<?= $booking_ticket->dropoff?>" autocomplete="off" maxlength="45" required>
                                    </div>
        
                                    <div class="mb-4 col-12 col-md-4 ">
                                        <label for="catatan" class="form-label">Remarks</label>
                                        <input type="text" class="form-control" id="catatan" name="catatan" placeholder="Enter Remarks..." value="<?= $booking_ticket->remarks?>" autocomplete="off" maxlength="45">
                                    </div>
                                </div>
                            </div>
                            <div id="additional-kembali" class="row">
                                <h2 class="text-decoration-underline">Return</h2>
                                <div class="row">
                                    <div class="mb-4 col-12 col-md-4">
                                        <label for="pickup" class="form-label">Pickup</label>
                                        <input type="text" class="form-control" id="pickup" name="r_pickup"  placeholder="Enter Pickup..." value="<?= $booking_ticket->r_pickup?>" autocomplete="off" maxlength="45">
                                    </div>
        
                                    <div class="mb-4 col-12 col-md-4 ">
                                        <label for="dropoff" class="form-label">Drop off</label>
                                        <input type="text" class="form-control" id="dropoff" name="r_dropoff" placeholder="Enter Drop Off..." value="<?= $booking_ticket->r_dropoff?>" autocomplete="off" maxlength="45">
                                    </div>

                                    <div class="col-4">
                                        <label for="payment" class="form-label">Select Payment</label>
                                        <select name="payment" id="payment" class="form-select">
                                            <?php foreach ($payment as $dt){?>
                                                <option value="<?=$dt["id"]?>" <?=($booking_ticket->payment == $dt['id']) ? "selected" : "" ?> ><?=$dt["payment"]?></option>
                                            <?php }?>
                                        </select>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="row">
                                <div class="col-4">
                                    <button id="cekHarga" class="btn btn-dark mt-3">Check Summary</button>
                                    <button type="submit" class="btn btn-primary mt-3">Edit Booking</button>
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
                                                            <h6 class="mb-0 fw-semibold">
                                                                Destination: <span class="display-tujuan">-</span>
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
                                                            <h6 class="mb-0 fw-semibold">Adult</h6>
                                                            <span class="fs-2">
                                                                <span class="display-dewasa-jumlah">0</span> Person
                                                            </span>
                                                        </div>
                                                        <!-- <div class="ms-auto text-end">
                                                            <span class="fs-2">Total Dewasa</span>
                                                            <h6 class="mb-0 fw-semibold">
                                                                Rp.<span class="display-total-harga-dewasa">0</span>
                                                            </h6>
                                                        </div> -->
                                                    </div>
                                                    <div class="d-flex align-items-center gap-3 py-3 border-bottom">
                                                        <div>
                                                            <h6 class="mb-0 fw-semibold">Child</h6>
                                                            <span class="fs-2">
                                                                <span class="display-anak-jumlah">0</span> Person
                                                            </span>
                                                        </div>
                                                        <!-- <div class="ms-auto text-end">
                                                            <span class="fs-2">Total Anak - Anak</span>
                                                            <h6 class="mb-0 fw-semibold">
                                                                Rp.<span class="display-total-harga-anak">0</span>
                                                            </h6>
                                                        </div> -->
                                                    </div>
                                                    <div class="d-flex align-items-center gap-3 py-3 border-bottom">
                                                        <div>
                                                            <h6 class="mb-0 fw-semibold">Free of Charge</h6>
                                                            <span class="fs-2">
                                                                <span class="display-foc-jumlah">0</span> Person    
                                                            </span>
                                                        </div>
                                                        <!-- <div class="ms-auto text-end">
                                                            <span class="fs-2">Total Free of Charge</span>
                                                            <h6 class="mb-0 fw-semibold">
                                                                Rp.<span class="display-total-harga-foc">0</span>
                                                            </h6>
                                                        </div> -->
                                                    </div>
                                                    <div class="d-flex align-items-center gap-3 py-3">
                                                        <div>
                                                            <h6 class="mb-0 fw-semibold">Total</h6>
                                                            <!-- <span class="fs-2">2 Orang</span> -->
                                                        </div>
                                                        <div class="ms-auto text-end">
                                                            <!-- <span class="fs-2">Rp.2.200,000</span> -->
                                                            <h6 class="mb-0 fw-semibold d-flex align-items-center">
                                                                <span>Rp.</span>
                                                                <span class="display-total-harga-final">
                                                                    <input type="text" class="form-control money-input input-total-rangkuman" value="<?= $booking_ticket->charge?>" name="total" required>
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
                                                                    <input type="text" class="form-control money-input input-total-rangkuman" value="<?= $booking_ticket->komisi?>" name="komisi">
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
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->


