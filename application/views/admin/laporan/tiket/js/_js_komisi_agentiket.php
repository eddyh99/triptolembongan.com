<link href='https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" />


<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.25/api/sum().js"></script>
<script>
    $(document).ready(function() {
        $('#tanggal').daterangepicker({
            startDate: moment(),
            endDate: moment(),
            opens: 'right',
            locale: {
                format: 'DD MMM YYYY'
            },
            ranges: {
                'Today': [moment(), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        });
        $('#table_laporan').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'pdf',
            ], 
            "drawCallback": function () {
                var api = this.api();
                var jt = api.column(1, {filter: 'applied'}).data().sum();
                var charge = api.column(2, {filter: 'applied'}).data().sum();
                var harga_agen = api.column(3, {filter: 'applied'}).data().sum();
                var selisih = api.column(4, {filter: 'applied'}).data().sum();
                $( api.column(1).footer() ).html(jt);
                $( api.column(2).footer() ).html(charge.toLocaleString('en'));
                $( api.column(3).footer() ).html(harga_agen.toLocaleString('en'));
                $( api.column(4).footer() ).html(selisih.toLocaleString('en'));
            },
        });
    });

    
</script>