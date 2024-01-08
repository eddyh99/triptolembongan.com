<style type="text/css">

    .printTagPreview { display: none; }

    @media print
    {
        .printTagPreview { display: block; }
    }
</style>
<script>
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