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

        $('.paket-select2').select2({
            placeholder: "Paket",
            allowClear: true,
            theme: "bootstrap",
        });

        $('.agent-select2').select2({
            placeholder: "Pilih Agent",
            allowClear: true,
            theme: "bootstrap"
        });


        // Call Ajax Nama Agent
        var id_agent_selected = $(this).find('.agent-select2 option:selected').val();
        $.ajax({  
            url: "<?=base_url()?>booking/get_paket_agent/"+id_agent_selected,
            type: "post",
            success: function(response) {
                var data = JSON.parse(response);
                $('.remove-paket-option').remove()
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
                        $('.paket-select2').append(`<option class="remove-paket-option" hargaPaket="${el.harga}" value="${el.id}" ${(el.id == '<?= $booking_paket->id_paket?>') ? 'selected' : ''}>${el.namapaket}</option>`);
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
                url: "<?=base_url()?>booking/get_paket_agent/"+id_agen,
                type: "post",
                success: function(response) {
                    var data = JSON.parse(response);
                    $('.remove-paket-option').remove()
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
                            $('.paket-select2').append(`<option class="remove-paket-option" hargaPaket="${el.harga}" value="${el.id}">${el.namapaket}</option>`);
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


    $(document).ready(function() {
        $.ajax({  
            url: "<?=base_url()?>booking/get_bookingpaket_detail/"+'<?= $booking_paket->id?>',
            type: "post",
            success: function(response) {
                var data = JSON.parse(response);
                const newData = [...data];
                newData.splice(0, 1);
                console.log(newData);
                newData.forEach((el) => {
                    if(el.jenis == 'dewasa'){
                        $('.wraping-add-booking-dewasa').append(`
                            <div class="adding-booking row">
                                <div class="mb-4 col-12 col-md-3 wrap-nama-tamu">
                                    <div class="d-flex align-items-center">
                                        <select class="nama-tamu-select2" name="nama_tamu_dewasa[]">
                                            <option value="${el.namatamu}">${el.namatamu}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4 col-12 col-md-3 wrap-nasionality">
                                    <select name="nasionality_dewasa[]" class="nasionality-select2">
                                        <option value="${el.nasionality} selected">${el.nasionality}</option>
                                        <?php foreach($list_negara as $dt){?>
                                            <option value="<?= $dt['name']?>"><?= $dt['name']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="mb-4 col-12 col-md-3 wrap-nama-tamu">
                                    <div class="d-flex align-items-center">
                                        <select class="nohp-tamu-select2" name="nohp_tamu_dewasa[]">
                                            <option value="${el.nope}">${el.nope}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4 col-12 col-md-2 wrap-nama-tamu">
                                    <div class="d-flex align-items-center">
                                        <select  class="email-tamu-select2" name="email_tamu_dewasa[]">
                                            <option value="${el.email}">${el.email}</option>
                                        </select>
                                    </div>
                                </div>
                                <i style="cursor: pointer;" class="d-block col-md-1 ti ti-circle-minus fs-8 text-danger remove-add-book-dewasa"></i>
                            </div>
                        `);
                    }
                });
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
            tap--;
        })
    })


</script>