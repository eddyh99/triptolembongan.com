
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.13.7/api/sum().js"></script>
<!-- DATE PICKER -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>



<script type="text/javascript">
    /* 
        TABS :
        &nbsp; // Regular space
        &ensp; // Two spaces gap
        &emsp; // Four spaces gap
    */


    var bookingtiket = $('#table_list_booking_ticket').DataTable({
            "scrollX": true,
            "order": [ 0, "asc" ],
            "ajax": {
                "url": "<?=base_url()?>booking/list_booking",
                "type": "POST",
                "data": function(d) {
                    d.tanggal = $("#tanggal").val();
                },
                "dataSrc":function (data){
                    return data;							
                }
            },
            "drawCallback": function () {
    			  var api = this.api();
    			  var total=Number(api.column(8, {filter: 'applied'}).cache('search').reduce( function (a, b) {return Number(a) + Number(b);}, 0 ));
    			  $( api.column( 8 ).footer() ).html(
    				total
    			  );
    		},    
            "columns": [
                {   
                    data: 'kode_tiket',
                    "sortable": false,  
                },
                {   
                    data: 'berangkat',
                    "sortable": false,  
                },
                {   
                    data: 'kembali', 
                    "sortable": false, 
                },
                {   
                    data: 'depart',
                    "sortable": false,  
                },
                {   
                    data: 'return_from', 
                    "sortable": false, 
                },
                {
                    data: null,
                    render: function(data, type, row){
                        return Number(row.dws);
                    },
                },
                {
                    data: null,
                    render: function(data, type, row){
                        return Number(row.anak);
                    },
                },
                {
                    data: null,
                    render: function(data, type, row){
                        return Number(row.foc);
                    },
                },
                {
                    data: null,
                    render: function(data, type, row){
                        var jumlah = 0;
                        jumlah = Number(row.dws) + Number(row.anak) + Number(row.foc);
                        return Number(jumlah);
                    },
                },
            ],
        });

    $('#tanggal').datepicker();

    $("#lihat").on("click",function(){
        bookingtiket.ajax.reload();
    })

    $("#depart").on("change",function(){
        bookingtiket
            .columns( 3 )
            .search( this.value )
            .draw();
    });
    $("#return").on("change",function(){
        bookingtiket
            .columns( 4 )
            .search( this.value )
            .draw();
    });
</script>