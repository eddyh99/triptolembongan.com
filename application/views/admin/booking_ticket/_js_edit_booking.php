<?php require('list_negara.php'); ?>
<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- DATE PICKER -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<style>
    .select2{
        width: 100% !important;
    }
    .input-group-append {
        cursor: pointer;
    }
    
    .select2-container--bootstrap .select2-selection--single {
        height: 38px;
    }
</style>

<script>


    // Render Select2 After Append Add Nama tamu and Nasionality
    function renderSelect2() {
        $('.nasionality-select2').select2({
            placeholder: "nasionality",
            theme: "bootstrap",
            allowClear: true,
            // templateResult: function(item) {
            //     return addCountry(item);
            // }
        });

        $('.nama-tamu-select2').select2({
            placeholder: "Nama Tamu",
            tags: true,
            selectOnClose: true,
            allowClear: true,
            theme: "bootstrap"
        });

        $('.nohp-tamu-select2').select2({
            placeholder: "No Hp/WA",
            tags: true,
            selectOnClose: true,
            allowClear: true,
            theme: "bootstrap"
        });

        $('.email-tamu-select2').select2({
            placeholder: "Email",
            tags: true,
            selectOnClose: true,
            allowClear: true,
            theme: "bootstrap"
        });
    }
    // Call Select 2 in append
    renderSelect2();

    // General Select2
    $(document).ready(function() {

        $('.depart-select2').select2({
            placeholder: "Depart",
            allowClear: true,
            theme: "bootstrap",
        });

        $('.return-select2').select2({
            placeholder: "Return",
            allowClear: true,
            theme: "bootstrap"
        });

        $('.agent-select2').select2({
            placeholder: "Pilih Agent",
            allowClear: true,
            theme: "bootstrap"
        });

        // Initial Tgl Berangkat - Kembali
        $(document).ready(function(){
            $(function() {
                $( "#tglberangkat" ).datepicker({
                    dateFormat: 'dd-mm-yy',
                    changeYear: true,
                    changeMonth: true,
                    minDate: 0,
                    yearRange: "-100:+20",
                });

                $( "#tglkembali" ).datepicker({
                    dateFormat: 'dd-mm-yy',
                    changeYear: true,
                    changeMonth: true,
                    minDate: 0,
                    yearRange: "-100:+20",
                });
            });
        });

        // Condition Tujuan and Initial Tgl Berangkat - Kembali
        $(document).ready(function(){
                let selected_value = $("input[name='tipetujuan']:checked").val();
                if(selected_value == 'Return'){
                    $(".return-select2").prop("disabled", false);
                    $("#tglkembali").prop("disabled", false);
                    $("#additional-kembali").show();
                }


                if(selected_value == 'One Way'){
                    $(".return-select2").prop("disabled", true);
                    $( "#tglkembali" ).datepicker('setDate','');
                    $("input[name='tglkembali']", $('#tglkembali')).val("");
                    $("#tglkembali").prop("disabled", true);
                    $("#additional-kembali").hide();
                }

                if(selected_value == 'Open'){
                    $(".return-select2").prop("disabled", true);
                    $( "#tglkembali" ).datepicker('setDate','');
                    $("input[name='tglkembali']", $('#tglkembali')).val("");
                    $("#tglkembali").prop("disabled", true);
                    $("#additional-kembali").hide();
                }
            
            $('.form-check-input').change(function(){
                let selected_value = $("input[name='tipetujuan']:checked").val();
                // let selected_open = $("input[name='tipeopen']:checked").val();
                // console.log(open_value);
                if(selected_value == 'Return'){
                    $(".return-select2").prop("disabled", false);
                    $("#tglkembali").prop("disabled", false);
                    $("#additional-kembali").show();
                }

                if(selected_value == 'One Way'){
                    $(".return-select2").prop("disabled", true);
                    $( "#tglkembali" ).datepicker('setDate','');
                    $("input[name='tglkembali']", $('#tglkembali')).val("");
                    $("#tglkembali").prop("disabled", true);
                    $("#additional-kembali").hide();
                }

                if(selected_value == 'Open'){
                    $(".return-select2").prop("disabled", true);
                    $( "#tglkembali" ).datepicker('setDate','');
                    $("input[name='tglkembali']", $('#tglkembali')).val("");
                    $("#tglkembali").prop("disabled", true);
                    $("#additional-kembali").hide();
                }
            });
        });



        // Call Ajax Nama Agent
        var id_agent_selected = $(this).find('.agent-select2 option:selected').val();
        $.ajax({  
            url: "<?=base_url()?>booking/get_ticket_agent/"+id_agent_selected,
            type: "post",
            success: function(response) {
                var data = JSON.parse(response);
                $('.remove-depart-option').remove()
                if(data.length === 0){ 
                    setTimeout(function() {
                        Swal.fire({
                            html: '<p>Data Paket per Agent Kosong</p>',
                            position: 'top',
                            timer: 3000,
                            showCloseButton: true,
                            showConfirmButton: false,
                            icon: 'error',
                            timer: 2000,
                            timerProgressBar: true,
                        });
                    }, 100);
                } else {
                    data.forEach((el) => {
                        $('.depart-select2').append(`
                            <option class="remove-depart-option"  hargaDepart="${el.harga}" value="${el.id}" ${(el.id == '<?= $booking_ticket->depart ?>') ? 'selected' : ''}>
                                ${el.tujuan} || ${el.berangkat}
                            </option>`);
                        $('.return-select2').append(`
                            <option class="remove-depart-option" hargaReturn="${el.harga}" value="${el.id}"  ${(el.id == '<?= $booking_ticket->return_from ?>') ? 'selected' : ''}>
                                ${el.tujuan} || ${el.berangkat}
                            </option>`);
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                setTimeout(function() {
                    Swal.fire({
                        html: `<p>Error ${textStatus}</p>`,
                        position: 'top',
                        timer: 3000,
                        showCloseButton: true,
                        showConfirmButton: false,
                        icon: 'error',
                        timer: 2000,
                        timerProgressBar: true,
                    });
                }, 100);
            }
        });

        $("select.agent-select2").on("change",function(e){
            e.preventDefault();
            var id_agen = $(this).val();
            $.ajax({  
                url: "<?=base_url()?>booking/get_ticket_agent/"+id_agen,
                type: "post",
                success: function(response) {
                    var data = JSON.parse(response);
                    $('.remove-depart-option').remove()
                    if(data.length === 0){ 
                        setTimeout(function() {
                            Swal.fire({
                                html: '<p>Data Paket per Agent Kosong</p>',
                                position: 'top',
                                timer: 3000,
                                showCloseButton: true,
                                showConfirmButton: false,
                                icon: 'error',
                                timer: 2000,
                                timerProgressBar: true,
                            });
                        }, 100);
                    } else {
                        data.forEach((el) => {
                            $('.depart-select2').append(`<option class="remove-depart-option"  hargaDepart="${el.harga}" value="${el.id}">${el.tujuan} || ${el.berangkat}</option>`);
                            $('.return-select2').append(`<option class="remove-depart-option" hargaReturn="${el.harga}" value="${el.id}">${el.tujuan} || ${el.berangkat}</option>`);
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    setTimeout(function() {
                        Swal.fire({
                            html: `<p>Error ${textStatus}</p>`,
                            position: 'top',
                            timer: 3000,
                            showCloseButton: true,
                            showConfirmButton: false,
                            icon: 'error',
                            timer: 2000,
                            timerProgressBar: true,
                        });
                    }, 100);
                }
            });
        });

    });

    // SHOW DATA EDIT
    $(document).ready(function() {
        $.ajax({  
            url: "<?=base_url()?>booking/get_bookingticket_detail/"+'<?= $booking_ticket->id?>',
            type: "post",
            success: function(response) {
                var data = JSON.parse(response);
                const dataDewasa = [];
                const dataAnak = [];
                const dataFOC = [];
                data.forEach((el) => {
                    if(el.jenis == 'dewasa'){
                        dataDewasa.push(
                            {
                                id_detail: el.id_detail,
                                namatamu: el.namatamu,
                                nasionality: el.nasionality,
                                nope: el.nope,
                                email: el.email,
                                jenis: el.jenis,
                                jnskel: el.jnskel
                            }
                        )
                    }

                    if(el.jenis == 'anak'){
                        dataAnak.push(
                            {
                                id_detail: el.id_detail,
                                namatamu: el.namatamu,
                                nasionality: el.nasionality,
                                nope: el.nope,
                                email: el.email,
                                jenis: el.jenis,
                                jnskel: el.jnskel
                            }
                        )
                    }
                    if(el.jenis == 'foc'){
                        dataFOC.push(
                            {
                                id_detail: el.id_detail,
                                namatamu: el.namatamu,
                                nasionality: el.nasionality,
                                nope: el.nope,
                                email: el.email,
                                jenis: el.jenis,
                                jnskel: el.jnskel
                            }
                        )
                    }
                });
                
                dataDewasa.splice(0, 1);
                dataDewasa.forEach((el) => {
                    var data=`
                        <div class="adding-booking row">
                            <div class="mb-4 col-12 col-md wrap-nama-tamu">
                                <div class="d-flex align-items-center">
                                    <select class="nama-tamu-select2" name="nama_tamu_dewasa[]">
                                        <option value="${el.namatamu}">${el.namatamu}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 col-12 col-md wrap-nasionality">
                                <select name="nasionality_dewasa[]" class="nasionality-select2">
                                    <option value="${el.nasionality}" selected>${el.nasionality}</option>
                                    <?php foreach($list_negara as $dt){?>
                                        <option value="<?= $dt['name']?>"><?= $dt['name']?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="mb-4 col-12 col-md wrap-nama-tamu">
                                <div class="d-flex align-items-center">
                                    <select class="nohp-tamu-select2" name="nohp_tamu_dewasa[]">
                                        <option value="${el.nope}">${el.nope}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 col-12 col-md wrap-nama-tamu">
                                <div class="d-flex align-items-center">
                                    <select  class="email-tamu-select2" name="email_tamu_dewasa[]">
                                        <option value="${el.email}">${el.email}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 col-12 col-md wrap-nama-tamu">
                                <div class="d-flex align-items-center">
                                    <select id="jnskel_dewasa" class="form-select" name="jnskel_dewasa[]">`;
                    if (el.jnskel=="Pria"){
                        data=data+`<option value="pria" selected>Pria</option><option value="wanita">Wanita</option>`;
                    }else{
                        data=data+`<option value="pria">Pria</option><option value="wanita" selected>Wanita</option>`;
                    }  
                    data=data+`</select>
                                </div>
                            </div>
                            <i style="cursor: pointer;" class="d-block col-md-1 ti ti-circle-minus fs-8 text-danger remove-add-book-dewasa"></i>
                        </div>
                    `;
                    $('.wraping-add-booking-dewasa').append(data);
                })
                
                dataAnak.splice(0, 1);
                dataAnak.forEach((el) => {
                    var data=`
                        <div class="adding-booking row">
                            <div class="mb-4 col-12 col-md-3 wrap-nama-tamu">
                                <div class="d-flex align-items-center">
                                    <select class="nama-tamu-select2" name="nama_tamu_anak[]">
                                        <option value="${el.namatamu}">${el.namatamu}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 col-12 col-md-3 wrap-nasionality">
                                <select name="nasionality_anak[]" class="nasionality-select2">
                                    <option value="${el.nasionality}" selected>${el.nasionality}</option>
                                    <?php foreach($list_negara as $dt){?>
                                        <option value="<?= $dt['name']?>"><?= $dt['name']?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="mb-4 col-12 col-md-3 wrap-nama-tamu">
                                <div class="d-flex align-items-center">
                                    <select class="nohp-tamu-select2" name="nohp_tamu_anak[]">
                                        <option value="${el.nope}">${el.nope}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 col-12 col-md-2 wrap-nama-tamu">
                                <div class="d-flex align-items-center">
                                    <select  class="email-tamu-select2" name="email_tamu_anak[]">
                                        <option value="${el.email}">${el.email}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 col-12 col-md wrap-nama-tamu">
                                <div class="d-flex align-items-center">
                                    <select id="jnskel_anak" class="form-select" name="jnskel_anak[]">`;
                    if (el.jnskel=="Pria"){
                        data=data+`<option value="pria" selected>Pria</option><option value="wanita">Wanita</option>`;
                    }else{
                        data=data+`<option value="pria">Pria</option><option value="wanita" selected>Wanita</option>`;
                    }  
                    data=data+`</select>
                                </div>
                            </div>
                            <i style="cursor: pointer;" class="d-block col-md-1 ti ti-circle-minus fs-8 text-danger remove-add-book-dewasa"></i>
                        </div>
                    `;
                    $('.wraping-add-booking-anak').append(data);
                })
                
                dataFOC.splice(0, 1);
                dataFOC.forEach((el) => {
                    var data=`
                        <div class="adding-booking row">
                            <div class="mb-4 col-12 col-md-3 wrap-nama-tamu">
                                <div class="d-flex align-items-center">
                                    <select class="nama-tamu-select2" name="nama_tamu_foc[]">
                                        <option value="${el.namatamu}">${el.namatamu}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 col-12 col-md-3 wrap-nasionality">
                                <select name="nasionality_foc[]" class="nasionality-select2">
                                    <option value="${el.nasionality}" selected>${el.nasionality}</option>
                                    <?php foreach($list_negara as $dt){?>
                                        <option value="<?= $dt['name']?>"><?= $dt['name']?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="mb-4 col-12 col-md-3 wrap-nama-tamu">
                                <div class="d-flex align-items-center">
                                    <select class="nohp-tamu-select2" name="nohp_tamu_foc[]">
                                        <option value="${el.nope}">${el.nope}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 col-12 col-md-2 wrap-nama-tamu">
                                <div class="d-flex align-items-center">
                                    <select  class="email-tamu-select2" name="email_tamu_foc[]">
                                        <option value="${el.email}">${el.email}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 col-12 col-md wrap-nama-tamu">
                                <div class="d-flex align-items-center">
                                    <select id="jnskel_foc" class="form-select" name="jnskel_foc[]">`;
                    if (el.jnskel=="Pria"){
                        data=data+`<option value="pria" selected>Pria</option><option value="wanita">Wanita</option>`;
                    }else{
                        data=data+`<option value="pria">Pria</option><option value="wanita" selected>Wanita</option>`;
                    }  
                    data=data+`</select>
                                </div>
                            </div>
                            <i style="cursor: pointer;" class="d-block col-md-1 ti ti-circle-minus fs-8 text-danger remove-add-book-foc"></i>
                        </div>
                    `
                    $('.wraping-add-booking-foc').append();
                })

                renderSelect2();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                setTimeout(function() {
                    Swal.fire({
                        html: `<p>Error ${textStatus}</p>`,
                        position: 'top',
                        timer: 3000,
                        showCloseButton: true,
                        showConfirmButton: false,
                        icon: 'error',
                        timer: 2000,
                        timerProgressBar: true,
                    });
                }, 100);
            }
        });

        $(".wraping-add-booking-dewasa").on("click", ".remove-add-book-dewasa", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            // tap--;
        })

        $(".wraping-add-booking-anak").on("click", ".remove-add-book-anak", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            // tap--;
        })

        $(".wraping-add-booking-foc").on("click", ".remove-add-book-foc", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            // tap--;
        })
    })

    // ADDING FOR NAMA TAMU & NATIONALITY DEWASA
    $(document).ready(function() {
        var max_taps = 30;
        var tap = 1;
        $(".add-nama-tamu-dewasa").click(function(e) {
            e.preventDefault();
            if (tap < max_taps) {
                tap++;
                $('.wraping-add-booking-dewasa').append(`
                    <div class="adding-booking row">
                        <div class="mb-4 col-12 col-md wrap-nama-tamu">
                            <div class="d-flex align-items-center">
                                <select class="nama-tamu-select2" name="nama_tamu_dewasa[]">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4 col-12 col-md wrap-nasionality">
                            <select name="nasionality_dewasa[]" class="nasionality-select2">
                                <option value=""></option>
                                <?php foreach($list_negara as $dt){?>
                                    <option value="<?= $dt['name']?>"><?= $dt['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="mb-4 col-12 col-md wrap-nama-tamu">
                            <div class="d-flex align-items-center">
                                <select class="nohp-tamu-select2" name="nohp_tamu_dewasa[]">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4 col-12 col-md wrap-nama-tamu">
                            <div class="d-flex align-items-center">
                                <select  class="email-tamu-select2" name="email_tamu_dewasa[]">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4 col-12 col-md wrap-nama-tamu">
                            <div class="d-flex align-items-center">
                                <select id="jnskel_dewasa" class="form-select" name="jnskel_dewasa[]">
                                    <option value="pria">Pria</option>
                                    <option value="wanita">Wanita</option>
                                </select>
                            </div>
                        </div>
                        <i style="cursor: pointer;" class="d-block col-md-1 ti ti-circle-minus fs-8 text-danger remove-add-book-dewasa"></i>
                    </div>
                `);
                // $(".wrap-nama-tamu").append('<div class="d-flex align-items-center mt-2 nama-tamu-add"><input type="text" class="form-control" id="nama_tamu" name="nama_tamu[]" placeholder="masukkan nama tamu..."></div>'); //add input box
                // $(".wrap-nasionality").append('<div class="d-flex align-items-center mt-2"><select name="nasionality[]" class="nasionality-select2"><?php foreach($list_negara as $dt){?><option value="<?= $dt['name']?>"><?= $dt['name']?></option><?php }?></select></div>'); 
                // $(".wrap-jenis-penumpang").append('<div class="d-flex align-items-center mt-2"> <select class="jenis-penumpang-select2" name="jenis_penumpang[]"><option ></option><option value="Dewasa">Dewasa</option><option value="Anak-Anak">Anak-Anak</option><option value="FOC">FOC</option></select><i style="cursor: pointer;" class="ti ti-circle-minus fs-8 ms-2 text-danger remove-add-booking"></i></div>'); 
                // $(".wrap-jenis-penumpang").append('<i style="cursor: pointer;" class="ti ti-circle-minus fs-8 ms-2 text-danger remove-add-book"></i>'); 
            } else {
                setTimeout(function() {
                    Swal.fire({
                        html: 'Tamu Dewasa Sudah Maximal, Buat Booking Paket Lagi Berikutnya',
                        position: 'top',
                        timer: 3000,
                        showCloseButton: true,
                        showConfirmButton: false,
                        icon: 'info',
                        timer: 2000,
                        timerProgressBar: true,
                    });
                }, 100);
            }
            renderSelect2();
        });

        $(".wraping-add-booking-dewasa").on("click", ".remove-add-book-dewasa", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            tap--;
        })

    });

    // ADDING FOR NAMA TAMU & NATIONALITY ANAK
    $(document).ready(function() {
        var max_taps = 30;
        var tap = 1;
        $(".add-nama-tamu-anak").click(function(e) {
            e.preventDefault();
            if (tap < max_taps) {
                tap++;
                $('.wraping-add-booking-anak').append(`
                    <div class="adding-booking row">
                        <div class="mb-4 col-12 col-md wrap-nama-tamu">
                            <div class="d-flex align-items-center">
                                <select class="nama-tamu-select2" name="nama_tamu_anak[]">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4 col-12 col-md wrap-nasionality">
                            <select name="nasionality_anak[]" class="nasionality-select2">
                                <option value=""></option>
                                <?php foreach($list_negara as $dt){?>
                                    <option value="<?= $dt['name']?>"><?= $dt['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="mb-4 col-12 col-md wrap-nama-tamu">
                            <div class="d-flex align-items-center">
                                <select class="nohp-tamu-select2" name="nohp_tamu_anak[]" >
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4 col-12 col-md wrap-nama-tamu">
                            <div class="d-flex align-items-center">
                                <select  class="email-tamu-select2" name="email_tamu_anak[]">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4 col-12 col-md wrap-nama-tamu">
                            <div class="d-flex align-items-center">
                                <select id="jnskel_anak" class="form-select" name="jnskel_anak[]">
                                    <option value="pria">Pria</option>
                                    <option value="wanita">Wanita</option>
                                </select>
                            </div>
                        </div>
                        <i style="cursor: pointer;" class="d-block col-md-1 ti ti-circle-minus fs-8 text-danger remove-add-book-anak"></i>
                    </div>
                `);
            } else {
                setTimeout(function() {
                    Swal.fire({
                        html: 'Tamu Anak Sudah Maximal, Buat Booking Paket Lagi Berikutnya',
                        position: 'top',
                        timer: 3000,
                        showCloseButton: true,
                        showConfirmButton: false,
                        icon: 'info',
                        timer: 2000,
                        timerProgressBar: true,
                    });
                }, 100);
            }
            renderSelect2();
        });

        $(".wraping-add-booking-anak").on("click", ".remove-add-book-anak", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            tap--;
        })

        $("#main-anak").on("click",function(e){
            e.preventDefault();
            $(".main-row-anak").remove();
            tap--;
        })

    });
    
    // ADDING FOR NAMA TAMU & NATIONALITY FOC
    $(document).ready(function() {
        var max_taps = 30;
        var tap = 1;
        $(".add-nama-tamu-foc").click(function(e) {
            e.preventDefault();
            if (tap < max_taps) {
                tap++;
                $('.wraping-add-booking-foc').append(`
                    <div class="adding-booking row">
                        <div class="mb-4 col-12 col-md wrap-nama-tamu">
                            <div class="d-flex align-items-center">
                                <select class="nama-tamu-select2" name="nama_tamu_foc[]">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4 col-12 col-md wrap-nasionality">
                            <select name="nasionality_foc[]" class="nasionality-select2">
                                <option value=""></option>
                                <?php foreach($list_negara as $dt){?>
                                    <option value="<?= $dt['name']?>"><?= $dt['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="mb-4 col-12 col-md wrap-nama-tamu">
                            <div class="d-flex align-items-center">
                                <select class="nohp-tamu-select2" name="nohp_tamu_foc[]" >
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4 col-12 col-md wrap-nama-tamu">
                            <div class="d-flex align-items-center">
                                <select class="email-tamu-select2" name="email_tamu_foc[]">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4 col-12 col-md wrap-nama-tamu">
                            <div class="d-flex align-items-center">
                                <select id="jnskel_foc" class="form-select" name="jnskel_foc[]">
                                    <option value="pria">Pria</option>
                                    <option value="wanita">Wanita</option>
                                </select>
                            </div>
                        </div>
                        <i style="cursor: pointer;" class="d-block col-md-1 ti ti-circle-minus fs-8 text-danger remove-add-book-foc"></i>
                    </div>
                `);
            } else {
                setTimeout(function() {
                    Swal.fire({
                        html: 'Tamu FOC Sudah Maximal, Buat Booking Paket Lagi Berikutnya',
                        position: 'top',
                        timer: 3000,
                        showCloseButton: true,
                        showConfirmButton: false,
                        icon: 'info',
                        timer: 2000,
                        timerProgressBar: true,
                    });
                }, 100);
            }
            renderSelect2();
        });

        $(".wraping-add-booking-foc").on("click", ".remove-add-book-foc", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            tap--;
        })
        
        $("#main-foc").on("click",function(e){
            e.preventDefault();
            $(".main-row-foc").remove();
            tap--;         
        })
    });

    var tipeAgent = $('#nama_agent option:selected').attr('data-tipe');
    if(tipeAgent == 'general'){
        $('#komisigeneral').removeClass('d-none').addClass('d-flex');;
    }else{
        $('#komisigeneral').removeClass('d-flex').addClass('d-none');;
    }
    $('#nama_agent').on("change", function(e) { 
        var tipeAgent = $('#nama_agent option:selected').attr('data-tipe');
        if(tipeAgent == 'general'){
            $('#komisigeneral').removeClass('d-none').addClass('d-flex');;
        }else{
            $('#komisigeneral').removeClass('d-flex').addClass('d-none');;
        }
    });
    

</script>