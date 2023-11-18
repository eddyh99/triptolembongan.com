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
                // $(".wrap-nama-tamu").append('<div class="d-flex align-items-center mt-2 nama-tamu-add"><input type="text" class="form-control" id="nama_tamu" name="nama_tamu[]" placeholder="masukkan nama tamu..."></div>'); //add input box
                // $(".wrap-nasionality").append('<div class="d-flex align-items-center mt-2"><select name="nasionality[]" class="nasionality-select2"><?php foreach($list_negara as $dt){?><option value="<?= $dt['name']?>"><?= $dt['name']?></option><?php }?></select></div>'); 
                // $(".wrap-jenis-penumpang").append('<div class="d-flex align-items-center mt-2"> <select class="jenis-penumpang-select2" name="jenis_penumpang[]"><option ></option><option value="Dewasa">Dewasa</option><option value="Anak-Anak">Anak-Anak</option><option value="FOC">FOC</option></select><i style="cursor: pointer;" class="ti ti-circle-minus fs-8 ms-2 text-danger remove-add-booking"></i></div>'); 
                // $(".wrap-jenis-penumpang").append('<i style="cursor: pointer;" class="ti ti-circle-minus fs-8 ms-2 text-danger remove-add-book"></i>'); 
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
                // $(".wrap-nama-tamu").append('<div class="d-flex align-items-center mt-2 nama-tamu-add"><input type="text" class="form-control" id="nama_tamu" name="nama_tamu[]" placeholder="masukkan nama tamu..."></div>'); //add input box
                // $(".wrap-nasionality").append('<div class="d-flex align-items-center mt-2"><select name="nasionality[]" class="nasionality-select2"><?php foreach($list_negara as $dt){?><option value="<?= $dt['name']?>"><?= $dt['name']?></option><?php }?></select></div>'); 
                // $(".wrap-jenis-penumpang").append('<div class="d-flex align-items-center mt-2"> <select class="jenis-penumpang-select2" name="jenis_penumpang[]"><option ></option><option value="Dewasa">Dewasa</option><option value="foc-foc">foc-foc</option><option value="FOC">FOC</option></select><i style="cursor: pointer;" class="ti ti-circle-minus fs-8 ms-2 text-danger remove-add-booking"></i></div>'); 
                // $(".wrap-jenis-penumpang").append('<i style="cursor: pointer;" class="ti ti-circle-minus fs-8 ms-2 text-danger remove-add-book"></i>'); 
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

    $(document).ready(function(){
        $('.form-check-input').change(function(){
            let selected_value = $("input[name='tipetujuan']:checked").val();
            if(selected_value == 'onewayradio'){
                $(".return-select2").prop("disabled", true);
            }
            if(selected_value == 'returnradio'){
                $(".return-select2").prop("disabled", false);
            }
        });

        $(function() {
            $( "#tglberangkat" ).datepicker({
                dateFormat: 'dd-mm-yy',
                // timeFormat:  "hh:mm:ss",
                changeYear: true,
                changeMonth: true,
                minDate: 0,
                yearRange: "-100:+20",
            });
        });
        // $('#tglberangkat').datepicker();
        $('#tglkembali').datepicker();
    });




</script>