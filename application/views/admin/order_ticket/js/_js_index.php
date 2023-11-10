<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- DATE PICKER -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<style>
    .select2{
        width: 100% !important;
    }
    .input-group-append {
        cursor: pointer;
    }
</style>


<script>

    $(document).ready(function() {
        var max_taps = 5;
        var tap = 1;
        $(".add-nama-tamu").click(function(e) {
            e.preventDefault();
            if (tap < max_taps) {
                tap++;
                $(".wrap-nama-tamu").append('<div class="d-flex align-items-center mt-2"><input type="text" class="form-control" id="nama_tamu" name="nama_tamu[]" placeholder="masukkan nama tamu..."><i style="cursor: pointer;" class="ti ti-circle-minus fs-8 ms-2 text-danger remove-nama-tamu"></i></div>'); //add input box
            } else {
                alert('You Reached the limits')
            }
        });

        $(".wrap-nama-tamu").on("click", ".remove-nama-tamu", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            tap--;
        })
    });
    



    function addCountry(item, state) {
        if (!item.id) {
            return item.text;
        }
        var countryUrl = "https://hatscripts.github.io/circle-flags/flags/";
        var url = countryUrl;
        var img = $("<img>", {
            class: "img-flag pe-2",
            width: 26,
            src: url + item.element.value.toLowerCase() + ".svg"
        });
        var span = $("<span>", {
            text: " " + item.text
        });
        span.prepend(img);
        return span;
    }

    $(document).ready(function() {
        $('.nasionality-select2').select2({
            placeholder: "nasionality",
            allowClear: true,
            theme: "bootstrap",
            templateResult: function(item) {
                return addCountry(item);
            }
        });


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

        $('#tglberangkat').datepicker();
        $('#tglkembali').datepicker();
    });




</script>