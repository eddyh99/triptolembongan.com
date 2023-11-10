<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>

    $(document).ready( function () {
        $('#table_list_agent').DataTable({
            "scrollX": true,
            "aoColumnDefs": [{	
				"aTargets": [4],
				"mRender": function (){
					button='<a href="<?=base_url()?>" class="btn btn-success"><i class="ti ti-pencil-minus fs-4"></i></a>'
					button = button + '<a href="<?=base_url()?>"class="del-data btn btn-danger mx-1"><i class="ti ti-trash"></i></a>';
					return button;
				}
			}],
        });

		// $(".time-picker").datepicker();
    });

	$('.jam_keberangkatan').timepicker({
    	timeFormat: 'h:mm p',
		interval: 30,
		minTime: '6',
		maxTime: '11:00pm',
		defaultTime: '06',
		startTime: '06:00',
		dynamic: false,
		dropdown: true,
		scrollbar: true
	});

</script>