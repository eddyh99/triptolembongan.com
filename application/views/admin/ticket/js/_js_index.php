<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>

	$(document).ready( function () {
        $('#table_list_ticket').DataTable({
            "scrollX": true,
			"ajax": {
				"url": "<?=base_url()?>ticket/list_ticket",
				"type": "POST",
				"dataSrc":function (data){
					return data;							
				}
			},
			"columns": [
				{ 	data: null,
					"sortable": false, 
       					render: function (data, type, row, meta) {
                 		return meta.row + meta.settings._iDisplayStart + 1;
                	}
				},
				{ data: 'tujuan' },
				{ data: 'berangkat' },
			],
            "aoColumnDefs": [{	
				"aTargets": [3],
				"mRender": function (data, type, full, meta){
					button='<a href="<?=base_url()?>ticket/edit_ticket/'+encodeURI(btoa(full.id))+'" class="btn btn-success"><i class="ti ti-pencil-minus fs-4"></i></a>'
					button = button + '<a href="<?=base_url()?>ticket/hapus/'+encodeURI(btoa(full.id))+'" class="del-data btn btn-danger mx-1"><i class="ti ti-trash"></i></a>';
					return button;
				}
			}],
        });
    } );

	$('.jam_keberangkatan').timepicker({
    	timeFormat: 'HH:mm',
		interval: 30,
		minTime: '6',
		maxTime: '11:00pm',
		defaultTime: '<?= (isset($ticket->berangkat)) ? $ticket->berangkat : '06:00'?>',
		startTime: '06:00',
		dynamic: false,
		dropdown: true,
		scrollbar: true
	});

</script>