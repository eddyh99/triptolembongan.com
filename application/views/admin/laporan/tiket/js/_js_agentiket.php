<link href='https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" />


<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
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
                'excel', 'pdf',
            ], 
            "drawCallback": function () {
                var api = this.api();
                var dws=api.column( 2,{filter:'applied'} ).data().sum();
                var anak=api.column( 3,{filter:'applied'} ).data().sum();
                var foc=api.column( 4,{filter:'applied'} ).data().sum();
                var total=api.column( 5,{filter:'applied'} ).data().sum();
                $( api.column( 2 ).footer() ).html(dws);
                $( api.column( 3 ).footer() ).html(anak);
                $( api.column( 4 ).footer() ).html(foc);
                $( api.column( 5 ).footer() ).html(total.toLocaleString('en'));
            },
        });
    });

    
</script>