<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<style>
    .th-keteranga-paket {
		width: 300px;
	}
</style>
<script type="text/javascript">
        
        $(document).ready( function () {
            $('#table_list_booking_paket').DataTable({
                "scrollX": true,
                "order": [[ 0, "asc" ]],
                "ajax": {
                    "url": "<?=base_url()?>booking/get_list_paket_agent",
                    "type": "POST",
                    "dataSrc":function (data){
                        console.log(data);
                        return data;							
                    }
                },
                "columns": [
                    { 	
                        data: null,
                        "sortable": true, 
                            render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
				    },
                    {   
                        data: 'kode_tiket',
                        "sortable": false
                    },
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
                    { 
                        data: 'namapaket', 
                        "sortable": false
                    },
                    { 
                        data: 'keterangan', 
                        "sortable": false
                    },
                ],
                "aoColumnDefs": [
                    {
                        "render": function(data, type, row){
                            var jumlah = 0;
                            jumlah = Number(row.dws) + Number(row.anak) + Number(row.foc);
                            return jumlah;
                        },
                        "targets": 6
                    },
                    {	
                        "aTargets": [7],
                        "mRender": function (data, type, full, meta, row){
                            var btnCancel;
                            if(full.del == 'no'){
                                btnCancel = '<a href="<?=base_url()?>booking/hapus_booking_paket/'+encodeURI(btoa(full.id))+'" class="del-data btn btn-danger "><i class="ti ti-trash"></i></a>';
                            }else if(full.del == 'yes') {
                                btnCancel = '<button disabled class="del-data btn btn-warning"><i class="ti ti-x"></i></button>';
                            }
                            // var btnCancel = '<a href="#" class="del-data btn btn-danger "><i class="ti ti-trash"></i></a>';
                            var btnInfo = `<div class="dropdown me-1">
                                                <button class="btn btn-secondary " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ti ti-info-circle"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">Nama Agen: <b>${full.namaagen}</b></a></li>
                                                    <li><a class="dropdown-item" href="#">Pickup: <b>${full.pickup}</b></a></li>
                                                    <li><a class="dropdown-item" href="#">Drop off: <b>${full.dropoff}</b></a></li>
                                                    <li><a class="dropdown-item" href="#">Payment: <b>${full.payment}</b></a></li>
                                                    <li>
                                                        <div class="dropdown-item">
                                                            <a class="btn btn-primary" href="<?= base_url()?>booking/download_ticket/${full.kode_tiket }">Download Ticket</a>
                                                        </div>
                                                    </li>
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
                        }
                    },
                ],
            });
        } );

</script>