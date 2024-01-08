<script type="text/javascript">
    $(document).ready( function () {
        $('#table_list_payment').DataTable({
            "scrollX": true,
			"ajax": {
				"url": "<?=base_url()?>payment/list_payment",
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
				{ data: 'payment' },
			],
            "aoColumnDefs": [{	
				"aTargets": [2],
				"mRender": function (data, type, full, meta){
					button='<a href="<?=base_url()?>payment/edit_payment/'+encodeURI(btoa(full.id))+'" class="btn btn-success"><i class="ti ti-pencil-minus fs-4"></i></a>'
					button = button + '<a href="<?=base_url()?>payment/hapus/'+encodeURI(btoa(full.id))+'" class="del-data btn btn-danger mx-1"><i class="ti ti-trash"></i></a>';
					return button;
				}
			}],
        });
    } );


	$(document).on("click", ".del-data", function(e){
		e.preventDefault();
		let url_href = $(this).attr('href');
		Swal.fire({
			text:"Are you sure you delete this data?",
			type: "warning",
			position: 'center',
			showCancelButton: true,
			confirmButtonText: "Delete",
			cancelButtonText: "Cancel",
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