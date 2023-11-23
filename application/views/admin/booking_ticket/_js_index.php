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

    // ADDING FOR NAMA TAMU & NATIONALITY DEWASA
    $(document).ready(function() {
        var max_taps = 5;
        var tap = 1;
        $(".add-nama-tamu-dewasa").click(function(e) {
            e.preventDefault();
            if (tap < max_taps) {
                tap++;
                $('.wraping-add-booking-dewasa').append(`
                    <div class="adding-booking row">
                        <div class="mb-4 col-12 col-md-6 wrap-nama-tamu">
                            <div class="d-flex align-items-center">
                                <select class="nama-tamu-select2" name="nama_tamu_dewasa[]">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4 col-12 col-md-5 wrap-nasionality">
                            <select name="nasionality_dewasa[]" class="nasionality-select2">
                                <option value=""></option>
                                <?php foreach($list_negara as $dt){?>
                                    <option value="<?= $dt['name']?>"><?= $dt['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <i style="cursor: pointer;" class="d-block col-md-1 ti ti-circle-minus fs-8 text-danger remove-add-book-dewasa"></i>
                    </div>
                `);
                // $(".wrap-nama-tamu").append('<div class="d-flex align-items-center mt-2 nama-tamu-add"><input type="text" class="form-control" id="nama_tamu" name="nama_tamu[]" placeholder="masukkan nama tamu..."></div>'); //add input box
                // $(".wrap-nasionality").append('<div class="d-flex align-items-center mt-2"><select name="nasionality[]" class="nasionality-select2"><?php foreach($list_negara as $dt){?><option value="<?= $dt['name']?>"><?= $dt['name']?></option><?php }?></select></div>'); 
                // $(".wrap-jenis-penumpang").append('<div class="d-flex align-items-center mt-2"> <select class="jenis-penumpang-select2" name="jenis_penumpang[]"><option ></option><option value="Dewasa">Dewasa</option><option value="Anak-Anak">Anak-Anak</option><option value="FOC">FOC</option></select><i style="cursor: pointer;" class="ti ti-circle-minus fs-8 ms-2 text-danger remove-add-booking"></i></div>'); 
                // $(".wrap-jenis-penumpang").append('<i style="cursor: pointer;" class="ti ti-circle-minus fs-8 ms-2 text-danger remove-add-book"></i>'); 
            } else {
                alert('You Reached the limits')
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
        var max_taps = 5;
        var tap = 1;
        $(".add-nama-tamu-anak").click(function(e) {
            e.preventDefault();
            if (tap < max_taps) {
                tap++;
                $('.wraping-add-booking-anak').append(`
                    <div class="adding-booking row">
                        <div class="mb-4 col-12 col-md-6 wrap-nama-tamu">
                            <div class="d-flex align-items-center">
                                <select class="nama-tamu-select2" name="nama_tamu_anak[]">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4 col-12 col-md-5 wrap-nasionality">
                            <select name="nasionality_anak[]" class="nasionality-select2">
                                <option value=""></option>
                                <?php foreach($list_negara as $dt){?>
                                    <option value="<?= $dt['name']?>"><?= $dt['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <i style="cursor: pointer;" class="d-block col-md-1 ti ti-circle-minus fs-8 text-danger remove-add-book-anak"></i>
                    </div>
                `);
            } else {
                alert('You Reached the limits')
            }
            renderSelect2();
        });

        $(".wraping-add-booking-anak").on("click", ".remove-add-book-anak", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            tap--;
        })

    });
    
    // ADDING FOR NAMA TAMU & NATIONALITY FOC
    $(document).ready(function() {
        var max_taps = 5;
        var tap = 1;
        $(".add-nama-tamu-foc").click(function(e) {
            e.preventDefault();
            if (tap < max_taps) {
                tap++;
                $('.wraping-add-booking-foc').append(`
                    <div class="adding-booking row">
                        <div class="mb-4 col-12 col-md-6 wrap-nama-tamu">
                            <div class="d-flex align-items-center">
                                <select class="nama-tamu-select2" name="nama_tamu_foc[]">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4 col-12 col-md-5 wrap-nasionality">
                            <select name="nasionality_foc[]" class="nasionality-select2">
                                <option value=""></option>
                                <?php foreach($list_negara as $dt){?>
                                    <option value="<?= $dt['name']?>"><?= $dt['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <i style="cursor: pointer;" class="d-block col-md-1 ti ti-circle-minus fs-8 text-danger remove-add-book-foc"></i>
                    </div>
                `);
            } else {
                alert('You Reached the limits')
            }
            renderSelect2();
        });

        $(".wraping-add-booking-foc").on("click", ".remove-add-book-foc", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            tap--;
        })

    });
    

    // function addCountry(item, state) {
    //     if (!item.id) {
    //         return item.text;
    //     }
    //     var countryUrl = "https://hatscripts.github.io/circle-flags/flags/";
    //     var url = countryUrl;
    //     var img = $("<img>", {
    //         class: "img-flag pe-2",
    //         width: 26,
    //         src: url + item.element.value.toLowerCase() + ".svg"
    //     });
    //     var span = $("<span>", {
    //         text: " " + item.text
    //     });
    //     span.prepend(img);
    //     return span;
    // }

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
    });

    // Condition Tujuan and Initial Tgl Berangkat - Kembali
    $(document).ready(function(){
        $('.form-check-input').change(function(){
            let selected_value = $("input[name='tipetujuan']:checked").val();
            if(selected_value == 'One Way'){
                $(".return-select2").prop("disabled", true);
            }
            if(selected_value == 'Return'){
                $(".return-select2").prop("disabled", false);
            }
        });

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


    // Call Ajax Nama Agent
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
                                html: '<p>Data Ticket per Agent Kosong</p>',
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

    // Main Summary 
    var hargaDepart;
    var hargaReturn;
    var harga = 0;
    var hargaDewasa = 0;
    var hargaAnak = 0;
    var hargaFOC = 0;
    $(function() {

        // On Change Harga Depart & Return
        $("#depart_select2").change(function(){
            hargaDepart = $('#depart_select2 option:selected').attr('hargaDepart');
        }); 

        $("#return_select2").change(function(){
            hargaReturn = $('#return_select2 option:selected').attr('hargaReturn');
        }); 

        // Click Cek Harga For Trigger Summary
        $("#cekHarga").click(function(e) {
            e.preventDefault();
    
            var getAgent =  $('#nama_agent').find(":selected").val();
            var getNamaAgent =  $('#nama_agent').find(":selected").text();
            var getTujuan = $('input[name="tipetujuan"]:checked').val();
            var getTglBerangkat = $('#tglberangkat').val();
            var getTglKembali = $('#tglkembali').val();

            var getDepart =  $('#depart_select2').find(":selected").text();
            var getReturn =  $('#return_select2').find(":selected").text();


            
            var inpt_tamu_dewasa = document.getElementsByName('nama_tamu_dewasa[]');
            var inpt_nasionality_dewasa = document.getElementsByName('nasionality_dewasa[]');
            var inpt_tamu_anak = document.getElementsByName('nama_tamu_anak[]');
            var inpt_nasionality_anak = document.getElementsByName('nasionality_anak[]');
            var inpt_tamu_foc = document.getElementsByName('nama_tamu_foc[]');
            var inpt_nasionality_foc = document.getElementsByName('nasionality_foc[]');


            var tempInput_dewasa = [];
            for (var i = 0; i < inpt_tamu_dewasa.length; i++) {
                var inpt = inpt_tamu_dewasa[i];
                tempInput_dewasa.push(inpt.value);
            }

            var tempInputNas_dewasa = [];
            for (var i = 0; i < inpt_nasionality_dewasa.length; i++) {
                var inpt = inpt_nasionality_dewasa[i];
                tempInputNas_dewasa.push(inpt.value);
            }

            var tempInput_anak = [];
            for (var i = 0; i < inpt_tamu_anak.length; i++) {
                var inpt = inpt_tamu_anak[i];
                tempInput_anak.push(inpt.value);
            }
            var tempInputNas_anak = [];
            for (var i = 0; i < inpt_nasionality_anak.length; i++) {
                var inpt = inpt_nasionality_anak[i];
                tempInputNas_anak.push(inpt.value);
            }

            var tempInput_foc = [];
            for (var i = 0; i < inpt_tamu_foc.length; i++) {
                var inpt = inpt_tamu_foc[i];
                tempInput_foc.push(inpt.value);
            }
            var tempInputNas_foc = [];
            for (var i = 0; i < inpt_nasionality_foc.length; i++) {
                var inpt = inpt_nasionality_foc[i];
                tempInputNas_foc.push(inpt.value);
            }

            if(getAgent == 'undefined'){
                // alert("TOLONG DIISI AGENT");
                setTimeout(function() {
                    Swal.fire({
                        html: '<p>Pilih Agen terlebih dahulu</p>',
                        position: 'top',
                        timer: 3000,
                        showCloseButton: true,
                        showConfirmButton: false,
                        icon: 'error',
                        timer: 2000,
                        timerProgressBar: true,
                    });
                }, 100);
            }else{
                if((getTujuan === 'Return') && hargaDepart !== undefined &&  hargaReturn !== undefined ){
                    if(
                        ((tempInput_dewasa == '' || tempInput_dewasa == null) || (tempInputNas_dewasa == '' || tempInputNas_dewasa == null)) && 
                        ((tempInput_anak == '' || tempInput_anak == null) || (tempInputNas_anak == '' || tempInputNas_anak == null)) &&
                        ((tempInput_foc == '' || tempInput_foc == null) || (tempInputNas_foc == '' || tempInputNas_foc == null)) 
                    ){
                        setTimeout(function() {
                            Swal.fire({
                                html: '<p>Nama tamu atau Nasionality belum diinputkan</p>',
                                position: 'top',
                                timer: 3000,
                                showCloseButton: true,
                                showConfirmButton: false,
                                icon: 'error',
                                timer: 2000,
                                timerProgressBar: true,
                            });
                        }, 100);
                        
                    }else {
                        
                        if((tempInput_dewasa == '' || tempInput_dewasa == null) || (tempInputNas_dewasa == '' || tempInputNas_dewasa == null)){
                            hargaDewasa = 0;
                            $(".display-dewasa-jumlah").text(0);
                            $(".display-total-harga-dewasa").text(hargaDewasa.toLocaleString("en"));
                        }else{
                            hargaDewasa = (hargaDepart * tempInput_dewasa.length) + (hargaReturn * tempInput_dewasa.length);
                            harga += hargaDewasa;
                            $(".display-dewasa-jumlah").text(tempInput_dewasa.length);
                            $(".display-total-harga-dewasa").text(hargaDewasa.toLocaleString("en"));
                        }
                        
                        if((tempInput_anak == '' || tempInput_anak == null) || (tempInputNas_anak == '' || tempInputNas_anak == null)){
                            hargaAnak = 0;
                            $(".display-anak-jumlah").text(0);
                            $(".display-total-harga-anak").text(hargaAnak.toLocaleString("en"));
                        }else{
                            hargaAnak = (hargaDepart * tempInput_anak.length) + (hargaReturn * tempInput_anak.length);
                            harga += hargaAnak;
                            $(".display-anak-jumlah").text(tempInput_anak.length);
                            $(".display-total-harga-anak").text(hargaAnak.toLocaleString("en"));
                        }

                        if((tempInput_foc == '' || tempInput_foc == null) || (tempInputNas_foc == '' || tempInputNas_foc == null)){
                            hargaFOC = 0;
                            $(".display-foc-jumlah").text(0);
                            $(".display-total-harga-foc").text(hargaFOC.toLocaleString("en"));
                        }else{
                            hargaFOC = (hargaDepart * tempInput_foc.length) + (hargaReturn * tempInput_foc.length);
                            $(".display-foc-jumlah").text(tempInput_foc.length);
                            $(".display-total-harga-foc").text(hargaFOC.toLocaleString("en"));
                        }
                        // alert(harga);
                        $(".display-nama-agent").text(getNamaAgent);
                        $(".display-tgl-berangkat").text(getTglBerangkat);
                        $(".display-tgl-kembali").text(getTglKembali);
                        $(".display-tujuan").text(getTujuan);
                        $(".display-depart").text(getDepart);
                        $(".display-return").text(getReturn);
                        $(".display-total-harga-final").text(harga.toLocaleString("en"));
                        harga = 0;
                    }
                }else if(getTujuan === 'One Way' && hargaDepart !== undefined){

                    if(
                        ((tempInput_dewasa == '' || tempInput_dewasa == null) || (tempInputNas_dewasa == '' || tempInputNas_dewasa == null)) &&
                        ((tempInput_anak == '' || tempInput_anak == null) || (tempInputNas_anak == '' || tempInputNas_anak == null)) &&
                        ((tempInput_foc == '' || tempInput_foc == null) || (tempInputNas_foc == '' || tempInputNas_foc == null))
                    ){
                        setTimeout(function() {
                            Swal.fire({
                                html: '<p>Nama tamu atau Nasionality belum diinputkan</p>',
                                position: 'top',
                                timer: 3000,
                                showCloseButton: true,
                                showConfirmButton: false,
                                icon: 'error',
                                timer: 2000,
                                timerProgressBar: true,
                            });
                        }, 100);
                    }else {
                        if((tempInput_dewasa == '' || tempInput_dewasa == null) || (tempInputNas_dewasa == '' || tempInputNas_dewasa == null)){
                            hargaDewasa = 0;
                            $(".display-dewasa-jumlah").text(0);
                            $(".display-total-harga-dewasa").text(hargaDewasa.toLocaleString("en"));
                        }else{
                            hargaDewasa = (hargaDepart * tempInput_dewasa.length);
                            harga += hargaDewasa;
                            $(".display-dewasa-jumlah").text(tempInput_dewasa.length);
                            $(".display-total-harga-dewasa").text(hargaDewasa.toLocaleString("en"));
                        }

                        if((tempInput_anak == '' || tempInput_anak == null) || (tempInputNas_anak == '' || tempInputNas_anak == null)){
                            hargaAnak = 0;
                            $(".display-anak-jumlah").text(0);
                            $(".display-total-harga-anak").text(hargaAnak.toLocaleString("en"));
                        }else{
                            hargaAnak = (hargaDepart * tempInput_anak.length);
                            $(".display-total-harga-anak").text(hargaAnak.toLocaleString("en"));
                            hargaAnak = 0;
                            harga += hargaAnak;
                            $(".display-anak-jumlah").text(tempInput_anak.length);
                        }
    
                        if((tempInput_foc == '' || tempInput_foc == null) || (tempInputNas_foc == '' || tempInputNas_foc == null)){
                            hargaFOC = 0;
                            $(".display-foc-jumlah").text(0);
                            $(".display-total-harga-foc").text(hargaFOC.toLocaleString("en"));
                        }else{
                            hargaFOC = (hargaDepart * tempInput_foc.length);
                            $(".display-foc-jumlah").text(tempInput_foc.length);
                            $(".display-total-harga-foc").text(hargaFOC.toLocaleString("en"));
                        }
                        $(".display-nama-agent").text(getNamaAgent);
                        $(".display-tgl-berangkat").text(getTglBerangkat);
                        $(".display-tgl-kembali").text(getTglKembali);
                        $(".display-tujuan").text(getTujuan);
                        $(".display-depart").text(getDepart);
                        $(".display-return").text('-');
                        $(".display-total-harga-final").text(harga.toLocaleString("en"));
                        harga = 0;
                    }

                } else {
                    setTimeout(function() {
                        Swal.fire({
                            html: '<p>Pilih Tujuan Dengan Benar</p>',
                            position: 'top',
                            timer: 3000,
                            showCloseButton: true,
                            showConfirmButton: false,
                            icon: 'error',
                            timer: 2000,
                            timerProgressBar: true,
                        });
                    }, 100);
                    // alert("TOLONG TUJUAN DIISI DENGAN BENAR")
                }
            }
        })
    })





</script>