<style type="text/css">

    .printTagPreview { display: none; }

    @media print
    {
        .printTagPreview { display: block; }
    }
</style>
<script>
    var bookingtiket = $("#table_list_booking_paket").DataTable({
        "ordering": false
    });

    $("#depart").on("change",function(){
        console.log(this.value);
        bookingtiket
            .columns( 3 )
            .search( this.value )
            .draw();
    });
    
    function valuePrint(kode,ad,an,fo){
        $('#dropoff').text(kode);
        $('#adult').text(ad);
        $('#child').text(an);
        $('#foc').text(fo);
        $('.printTagPreview').printThis({
            removeScripts: true, 
        }).then()
        //$('.printTagPreview').hide()
        return false;
    }
</script>