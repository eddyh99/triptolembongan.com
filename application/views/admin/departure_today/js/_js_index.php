<style type="text/css">

    .printTagPreview { display: none; }

    @media print
    {
        .printTagPreview { display: block; }
    }
</style>
<script>
    $("#table_list_booking_paket").DataTable({
        "ordering": false
    });

    $("#depart").on("change",function(){
        console.log(this.value);
        bookingtiket
            .columns( 2 )
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