
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- DATE PICKER -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<style>
    .th-depart-ticket {
		width: 180px;
	}
    .th-return-ticket {
		width: 180px;
	}

    @media print {
        @page {
            size: 80mm 310mm;
            margin: 10mm;
        }
        .booking-print {
            display: block;
            width: 100%;
            height: auto;
        }

        ol {
            margin: 10px;
            padding: 0;
        }

        ol li {
            
            font-size: 10px;
        }
    }

    @media screen {
        .booking-print {
            display: none;
            width: 100%;
            height: auto;
        }
    }
</style>


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
                "url": "<?=base_url()?>booking/get_list_ticket_agent",
                "type": "POST",
                "data": function(d) {
                    d.tanggal = $("#tanggal").val();
                    d.tipeticket = $("#tipeticket").val()
                },
                "dataSrc":function (data){
                    console.log(data);
                    return data;							
                }
            },
            "columns": [
                {   
                    data: 'kode_tiket',
                    "sortable": false,  
                },
                {   
                    data: 'namatamu',
                    "sortable": false,  
                },
                {   
                    data: 'depart',
                    "sortable": false,  
                },
                { 
                    data: null, 
                    "sortable": false, 
                    render: function (data, type, row, meta) {
                        var berangkat = row.berangkat;
                        if(row.berangkat !== null){
                            berangkat = berangkat.split("-").reverse().join("-");
                        }
                        return berangkat;
                    }
                },
                {   
                    data: 'return_from', 
                    "sortable": false, 
                },
                { 
                    data: null,
                    "sortable": false, 
                    render: function (data, type, row, meta) {
                        var kembali = row.kembali;
                        if(row.kembali !== null){
                            kembali = kembali.split("-").reverse().join("-");
                        }
                        return kembali;
                    }
                },
                {
                    data: null,
                    render: function(data, type, row){
                        var jumlah = 0;
                        jumlah = Number(row.dws) + Number(row.anak) + Number(row.foc);
                        return jumlah;
                    },
                },
                {
                    data:'reserved'
                }
            ],
            "aoColumnDefs": [
                {	
                    "aTargets": [8],
                    "mRender": function (data, type, full, meta, row){
                        var btnCancel;
                        if(full.del == 'no'){
                            btnCancel = '<a href="<?=base_url()?>booking/hapus_booking_ticket/'+encodeURI(btoa(full.id))+'" class="del-data btn btn-danger "><i class="ti ti-trash"></i></a>';
                        }else if(full.del == 'yes') {
                            btnCancel = '<button disabled class="del-data btn btn-warning"><i class="ti ti-x"></i></button>';
                        }
                        var btnEdit = '<a href="<?=base_url()?>booking/edit_booking_ticket/'+encodeURI(btoa(full.id))+'" class="btn btn-success"><i class="ti ti-pencil-minus fs-4"></a>';

                        var chargePrint = parseInt(full.charge);
                        chargePrint = chargePrint.toLocaleString("en")

                        var btnInfo = `<div class="dropdown me-1">
                                            <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#addinfo${full.kode_tiket}">
                                                <i class="ti ti-info-circle"></i>
                                            </button> 
                                            <div class="modal fade" id="addinfo${full.kode_tiket}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Additional Information</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Agen : ${full.namaagen}</h6>
                                                        <h6>Pickup : ${full.pickup}</h6>
                                                        <h6>Dropoff : ${full.dropoff}</h6>
                                                        <h6>Payment : ${full.payment}</h6>
                                                        ${(function is_open(){
                                                            var open =''
                                                            if(full.kembali == null && full.is_open == 'yes'){
                                                                open += `
                                                                    <hr>
                                                                    <form action="<?= base_url()?>booking/update_open_proses/${full.id}" method="POST">
                                                                        <div class="col-10">
                                                                            <label for="return" class="form-label">Tanggal Keberangkatan</label>
                                                                            <div class="form-control d-flex">
                                                                                <input type="date" class="w-100 border-0 cursor-pointer" name="return" id="return" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-success mt-2">Update Open</button>
                                                                    </form>
                                                                    
                                                                `;
                                                            }
                                                            return open;
                                                        })()}
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;

                        var btnOpen = `<div class="dropdown me-1">
                                            <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#addinfo${full.id}">
                                                <i class="ti ti-info-circle"></i>
                                            </button> 
                                            <div class="modal fade" id="addinfo${full.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Additional Information</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Agen : ${full.namaagen}</h6>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;

                        var btnPrint = `
                            <button id="printTiket${full.kode_tiket}" onClick="valuePrint('${full.kode_tiket}')" class="btn btn-warning me-1"><i class="ti fs-5 ti-printer"></i></button>
                            <div class="booking-print printTiketPreview${full.kode_tiket}">
                                <div class="d-flex justify-content-center mt-5 mb-2">
                                    <img class="text-center d-block img-fluid" src="<?= base_url()?>assets/img/arthamas.png" width="100mm" height="auto">
                                </div>
                                <span class="text-center d-block fst-italic fs-2">Jalan Matahari Terbit, Pertokoan ARCADE, No.4, Sanur, Denpasar Selatan</span>
                                <hr>
                                <span class="fs-2"><b>Ticket</b>&emsp;&emsp;&nbsp;&ensp; : ${full.kode_tiket}</span>
                                <br>
                                <span class="fs-2 "><b>Agent</b>&emsp;&emsp;&nbsp;&ensp; : ${full.namaagen}</span>
                                <br>
                                <span class="fs-2"><b>Tamu</b>&emsp;&emsp;&ensp;&nbsp;&ensp; : ${full.namatamu}</span>
                                <br>
                                <span class="fs-2"><b>Country</b>&emsp;&nbsp;&ensp; : ${full.nasionality}</span>
                                <br>
                                <span class="fs-2"><b>Tipe Trip</b>&emsp;&nbsp;&ensp; : ${(full.depart != null) && (full.return_from != null) ? 'Return' : 'One Way' }</span>
                                <br>
                                <br>
                                <span class="fs-2"><b>Depart</b>&emsp;&ensp;&nbsp;&ensp; : ${full.p_depart}</span>
                                <br>
                                <span class="fs-2"><b>Date</b>&emsp;&emsp;&ensp;&nbsp;&ensp; : ${(full.berangkat != null) ? full.berangkat.split("-").reverse().join("-") : ''}</span>
                                <br>
                                <span class="fs-2"><b>Time</b>&emsp;&emsp;&ensp;&nbsp;&ensp; : ${full.p_time}</span>
                                <br>
                                <span class="fs-2"><b>Pickup</b>&emsp;&ensp;&nbsp;&ensp; : ${full.pickup}</span>
                                <br>
                                <span class="fs-2"><b>DropOff</b>&emsp;&ensp; : ${full.dropoff}</span>
                                <br>
                                <br>
                                <span class="fs-2"><b>R_Depart</b>&emsp; : ${(full.r_depart != null) ? full.r_depart : ''}</span>
                                <br>
                                <span class="fs-2"><b>R_Date</b>&emsp;&emsp; : ${(full.kembali != null) ? full.kembali.split("-").reverse().join("-") : ''}</span>
                                <br>
                                <span class="fs-2"><b>R_Time</b>&emsp;&emsp; : ${(full.r_time != null) ? full.r_time : ''}</span>
                                <br>
                                <span class="fs-2"><b>R_Pickup</b>&emsp; : ${(full.r_pickup != null) ? full.r_pickup : ''}</span>
                                <br>
                                <span class="fs-2"><b>R_DropOff</b>&nbsp; : ${(full.r_dropoff != null) ? full.r_dropoff : ''}</span>
                                <br>
                                <br>
                                <span class="fs-2"><b><u>Remarks</u></b>&emsp;&emsp; : ${full.remarks}</span>
                                <br>
                                <br>
                                <span class="fs-2">Adult: ${full.dws}, Child: ${full.anak}, FOC: ${full.foc}</span>
                                <br>
                                <hr>
                                <div>
                                    <span><u>Term and Condition : </u></span>
                                    <ol>
                                        <li>Cancelation 100% no refundable</li>
                                        <li>OPEN ticket based on seat avaliability and should be made at least 1 day prior to the guest departure</li>
                                        <li>Passanger with particular health problem, physical handicap and pregnant woman will travel at their own risk</li>
                                        <li>Arthamas Express Fast Boat will not responsible for any loss or damage to the luggage during transfering to the island due to the bad weather and the guest personal belonging while joining the trip</li>
                                        <li>If our boat is unable to departure because of technical problem then we will endeavor to transfer guest to another boat.</li>
                                        <li>CONNECTING FLIGHT, Arthamas Express Fast Boat does not take any responsibility for any delays or connecting flight that caused by delay vessel or beyond their control (i.e. weather, road blockage/ traffic jam, ceremonies, or other unforessen circumtances)</li>
                                    </ol>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span style="font-size:8px;">Guest Sign</span>
                                        <input type="text" style="width: 25mm;height: 15mm;">
                                    </div>
                                    <div>
                                        <span style="font-size:8px;">Reservation</span>
                                        <input type="text" style="width: 25mm;height: 15mm;">
                                    </div>
                                </div>
                            </div>
                        `;

                        var btnPrint2 = `
                            <button id="printTiket${full.kode_tiket}" onClick="valuePrint2('${full.kode_tiket}')" class="btn btn-danger me-1"><i class="ti fs-5 ti-printer"></i></button>
                            <div class="booking-print print2TiketPreview${full.kode_tiket}">
                                <div class="d-flex justify-content-center mt-5 mb-2">
                                    <img class="text-center d-block img-fluid" src="<?= base_url()?>assets/img/arthamas.png" width="100mm" height="auto">
                                </div>
                                <span class="text-center d-block fst-italic fs-2">Jalan Matahari Terbit, Pertokoan ARCADE, No.4, Sanur, Denpasar Selatan</span>
                                <hr>
                                <span class="fs-2"><b>Ticket</b>&emsp;&emsp;&nbsp;&ensp; : ${full.kode_tiket}</span>
                                <br>
                                <span class="fs-2 "><b>Agent</b>&emsp;&emsp;&nbsp;&ensp; : ${full.namaagen}</span>
                                <br>
                                <span class="fs-2"><b>Tamu</b>&emsp;&emsp;&ensp;&nbsp;&ensp; : ${full.namatamu}</span>
                                <br>
                                <span class="fs-2"><b>Country</b>&emsp;&nbsp;&ensp; : ${full.nasionality}</span>
                                <br>
                                <span class="fs-2"><b>Tipe Trip</b>&emsp;&nbsp;&ensp; : ${(full.depart != null) && (full.return_from != null) ? 'Return' : 'One Way' }</span>
                                <br>
                                <br>
                                <span class="fs-2"><b>Depart</b>&emsp;&ensp;&nbsp;&ensp; : ${full.p_depart}</span>
                                <br>
                                <span class="fs-2"><b>Date</b>&emsp;&emsp;&ensp;&nbsp;&ensp; : ${(full.berangkat != null) ? full.berangkat.split("-").reverse().join("-") : ''}</span>
                                <br>
                                <span class="fs-2"><b>Time</b>&emsp;&emsp;&ensp;&nbsp;&ensp; : ${full.p_time}</span>
                                <br>
                                <span class="fs-2"><b>Pickup</b>&emsp;&ensp;&nbsp;&ensp; : ${full.pickup}</span>
                                <br>
                                <span class="fs-2"><b>DropOff</b>&emsp;&ensp; : ${full.dropoff}</span>
                                <br>
                                <br>
                                <span class="fs-2"><b>R_Depart</b>&emsp; : ${(full.r_depart != null) ? full.r_depart : ''}</span>
                                <br>
                                <span class="fs-2"><b>R_Date</b>&emsp;&emsp; : ${(full.kembali != null) ? full.kembali.split("-").reverse().join("-") : ''}</span>
                                <br>
                                <span class="fs-2"><b>R_Time</b>&emsp;&emsp; : ${(full.r_time != null) ? full.r_time : ''}</span>
                                <br>
                                <span class="fs-2"><b>R_Pickup</b>&emsp; : ${(full.r_pickup != null) ? full.r_pickup : ''}</span>
                                <br>
                                <span class="fs-2"><b>R_DropOff</b>&nbsp; : ${(full.r_dropoff != null) ? full.r_dropoff : ''}</span>
                                <br>
                                <br>
                                <span class="fs-2"><b><u>Remarks</u></b>&emsp;&emsp; : ${full.remarks}</span>
                                <br>
                                <span class="fs-2"><b><u>Charge</u></b>&emsp;&emsp; : ${chargePrint}</span>
                                <br>
                                <br>
                                <span class="fs-2">Adult: ${full.dws}, Child: ${full.anak}, FOC: ${full.foc}</span>
                                <br>
                                <hr>
                                <div>
                                    <span><u>Term and Condition : </u></span>
                                    <ol>
                                        <li>Cancelation 100% no refundable</li>
                                        <li>OPEN ticket based on seat avaliability and should be made at least 1 day prior to the guest departure</li>
                                        <li>Passanger with particular health problem, physical handicap and pregnant woman will travel at their own risk</li>
                                        <li>Arthamas Express Fast Boat will not responsible for any loss or damage to the luggage during transfering to the island due to the bad weather and the guest personal belonging while joining the trip</li>
                                        <li>If our boat is unable to departure because of technical problem then we will endeavor to transfer guest to another boat.</li>
                                        <li>CONNECTING FLIGHT, Arthamas Express Fast Boat does not take any responsibility for any delays or connecting flight that caused by delay vessel or beyond their control (i.e. weather, road blockage/ traffic jam, ceremonies, or other unforessen circumtances)</li>
                                    </ol>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span style="font-size:8px;">Guest Sign</span>
                                        <input type="text" style="width: 25mm;height: 15mm;">
                                    </div>
                                    <div>
                                        <span style="font-size:8px;">Reservation</span>
                                        <input type="text" style="width: 25mm;height: 15mm;">
                                    </div>
                                </div>
                            </div>
                        `;
                        
                        var date = moment();
                        var currentDate = date.format('YYYY-MM-D');
                        var temp;
                        if(moment(full.berangkat).isSameOrAfter(currentDate) && full.checkin_by == null){
                            temp = `<div class="d-flex">${btnInfo} ${btnPrint} ${btnPrint2} ${btnEdit}</div>`;
                        }else{
                            temp = `<div class="d-flex">${btnInfo} ${btnPrint} ${btnPrint2}</div>`;                                
                        }
                        return temp;
                    }
                },
            ],
        });

    function valuePrint(kode){
        $(`.printTiketPreview${kode}`).printThis({
            removeScripts: true, 
        })
        return false;
    }

    function valuePrint2(kode){
        $(`.print2TiketPreview${kode}`).printThis({
            removeScripts: true, 
        })
        return false;
    }

    $('#tanggal').daterangepicker({
        startDate: moment(),
        endDate: moment(),
        opens: 'right',
        locale: {
            format: 'DD MMM YYYY'
        },
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().add(-1, 'days'), moment().add(-1, 'days'),],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
        }
    });

    $("#lihat").on("click",function(){
        bookingtiket.ajax.reload();
    })

    $("#depart").on("change",function(){
        console.log(this.value);
        bookingtiket
            .columns( 2 )
            .search( this.value )
            .draw();
    });

    $(function() {
        $('.modal').on('shown.bs.modal', function () {
            $('#editStartTime').datetimepicker();
            });
            $( "#dateReturn" ).datepicker({
                dateFormat: 'dd-mm-yy',
                changeYear: true,
                changeMonth: true,
                minDate: 0,
                yearRange: "-100:+20",
            }).val('');
        });
    
    $(document).on("click", ".del-data", function(e){
		e.preventDefault();
		let url_href = $(this).attr('href');
		Swal.fire({
			text:"Are you sure you delete this data?",
			type: "warning",
			position: 'center',
			showCancelButton: true,
			confirmButtonText: "Hapus",
			cancelButtonText: "Batal",
			confirmButtonColor: '#FA896B',
			closeOnConfirm: true,
			showLoaderOnConfirm: true,
		}).then((result) => {
			if (result.isConfirmed) {
				document.location.href = url_href;
			}
		})
	});

</script>