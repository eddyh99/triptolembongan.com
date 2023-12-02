<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<style>
    .th-keteranga-paket {
		width: 300px;
	}

    @media print {
        @page {
            size: 80mm 150mm;
            margin: 10mm;
        }
        .booking-paket-print {
            display: block;
            width: 100%;
            height: auto;
        }
    }

    @media screen {
        .booking-paket-print {
            display: none;
            width: 100%;
            height: auto;
        }
    }
</style>
<script type="text/javascript">
        
        $(document).ready( function () {
            $('#table_list_booking_paket').DataTable({
                "scrollX": true,
                "order": [[ 0, "desc" ]],
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

                            var chargePrint = parseInt(full.charge);
                            chargePrint = chargePrint.toLocaleString("en")


                            var btnInfo = `<div class="dropdown me-1">
                                                <button class="btn btn-secondary " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ti ti-info-circle"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">Nama Agen: <b>${full.namaagen}</b></a></li>
                                                    <li><a class="dropdown-item" href="#">Pickup: <b>${full.pickup}</b></a></li>
                                                    <li><a class="dropdown-item" href="#">Drop off: <b>${full.dropoff}</b></a></li>
                                                    <li><a class="dropdown-item" href="#">Payment: <b>${full.payment}</b></a></li>
                                                </ul>
                                            </div>`;

                            var btnPrint = `
                                    <button id="printTiket${full.kode_tiket}" class="btn btn-success me-1"><i class="ti fs-5 ti-printer"></i></button>
                                    <div class="booking-paket-print printTiketPreview${full.kode_tiket} bg-primary">
                                        <div class="d-flex justify-content-center">
                                            <img class="text-center d-block" src="<?= base_url()?>assets/img/favicon.png" width="60mm" height="auto">
                                        </div>
                                        <h3 class="text-center fw-bolder">TRIPTO<span class="text-secondary">LEMBONGAN</span></h3>   
                                        <span class="text-center d-block fst-italic fs-2">Jln Denpasar - Gilimanuk No 1 Mengwi Badung Bali</span>
                                        <hr>
                                        <span class="fs-2"><b>Ticket</b>&emsp;&emsp;&nbsp;&ensp; : ${full.kode_tiket}</span>
                                        <br>
                                        <span class="fs-2 "><b>Agent</b>&emsp;&emsp;&nbsp;&ensp; : ${full.namaagen}</span>
                                        <br>
                                        <span class="fs-2"><b>Tamu</b>&emsp;&emsp;&ensp;&ensp; : ${full.namatamu}</span>
                                        <br>
                                        <span class="fs-2"><b>Country</b>&emsp;&nbsp;&ensp; : ${full.nasionality}</span>
                                        <br>
                                        <br>
                                        <span class="fs-2"><b>Paket</b>&emsp;&emsp;&ensp;&nbsp; : ${full.namapaket}</span>
                                        <br>
                                        <span class="fs-2"><b>Date</b>&emsp;&emsp;&ensp;&nbsp;&ensp; : ${(full.berangkat != null) ? full.berangkat.split("-").reverse().join("-") : ''}</span>
                                        <br>
                                        <span class="fs-2"><b>R_Date</b>&emsp;&ensp;&nbsp;&nbsp; : ${(full.kembali != null) ? full.kembali.split("-").reverse().join("-") : ''}</span>
                                        <br>
                                        <span class="fs-2"><b>Pickup</b>&emsp;&ensp;&nbsp;&ensp; : ${full.pickup}</span>
                                        <br>
                                        <span class="fs-2"><b>DropOff</b>&emsp;&ensp; : ${full.dropoff}</span>
                                        <br>
                                        <br>
                                        <span class="fs-2"><b><u>Charge</u></b>&emsp;&emsp; : ${chargePrint}</span>
                                        <br>
                                        <br>
                                        <span class="fs-2">Adult: ${full.dws}, Child: ${full.anak}, FOC: ${full.foc}</span>
                                    </div>
                            `;

                            $(`#printTiket${full.kode_tiket}`).on('click', function(){
                                $(`.printTiketPreview${full.kode_tiket}`).printThis({
                                    removeScripts: true, 
                                })
                            })
                            
                            var date = moment();
                            var currentDate = date.format('YYYY-MM-D');
                            var temp;
                            if(moment(full.berangkat).isAfter(currentDate)){
                                temp = `<div class="d-flex">${btnInfo} ${btnPrint} ${btnCancel}</div>`;
                            }else{
                                temp = `<div class="d-flex">${btnInfo} ${btnPrint}</div>`;;
                            }
                            return temp;
                        }
                    },
                ],
            });
        } );

</script>