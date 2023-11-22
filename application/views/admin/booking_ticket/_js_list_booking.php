<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

<script type="text/javascript">
        
        $(document).ready( function () {
            $('#table_list_booking_ticket').DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "<?=base_url()?>booking/get_list_ticket_agent",
                    "type": "POST",
                    "dataSrc":function (data){
                        return data;							
                    }
                },
                "columns": [
                    { data: 'kode_tiket' },
                    { 
                        data: null, 
                        "sortable": false, 
       					render: function (data, type, row, meta) {
                            var berangkat = row.berangkat;
                            berangkat = berangkat.split("-").reverse().join("-");
                 		    return berangkat;
                	    }
                    },
                    { 
                        data: null,
                        "sortable": false, 
       					render: function (data, type, row, meta) {
                            var kembali = row.kembali;
                            kembali = kembali.split("-").reverse().join("-");
                 		    return kembali;
                	    }
                    },
                    { data: 'depart' },
                    { data: 'return_from' },
                ],
                "aoColumnDefs": [
                    {
                        "render": function(data, type, row){
                            var jumlah = 0;
                            jumlah = Number(row.dws) + Number(row.anak) + Number(row.foc);
                            return jumlah;
                        },
                        "targets": 5
                    },
                    {	
                        "aTargets": [6],
                        "mRender": function (data, type, full, meta, row){
                            var btnCancel = '<a href="#" class="del-data btn btn-danger "><i class="ti ti-trash"></i></a>';
                            var btnInfo = `<div class="dropdown me-1">
                                                <button class="btn btn-secondary " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ti ti-info-circle"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">Nama Agen: <b>${full.namaagen}</b></a></li>
                                                    <li><a class="dropdown-item" href="#">Pickup: <b>${full.pickup}</b></a></li>
                                                    <li><a class="dropdown-item" href="#">Drop off: <b>${full.dropoff}</b></a></li>
                                                </ul>
                                            </div>`;
                            var date = moment();
                            var currentDate = date.format('YYYY-MM-D');
                            var temp;
                            if(moment(full.berangkat).isAfter(currentDate)){
                                temp = `<div class="d-flex">${btnInfo} ${btnCancel}</div>`;
                            }else{
                                temp = btnInfo;
                            }
                            return temp;
                            // if(full.berangkat == currentDate){
                            //     return "BERAKHIR";
                            // }else{
                            //     return "MASIH";
                            // }
                        }
                    },
                ],
            });
        } );

</script>