<style>
	.th-role {
		width: 500px;
	}
</style>

<script type="text/javascript">

	const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
	const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

	$('#table_list_user').DataTable({
		"scrollX": true,
		"ajax": {
			"url": "<?=base_url()?>user/list_user",
			"type": "POST",
			"dataSrc":function (data){
				console.log(data);
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
			{ data: 'username' },
			{ data: 'keterangan' },
			{ data: 'lokasi' },
		],
		"aoColumnDefs": [{	
			"aTargets": [4],
			"mRender": function (data, type, full, meta){
				button='<a href="<?=base_url()?>user/edit_user/'+encodeURI(btoa(full.username))+'" class="btn btn-success mx-1 my-1"><i class="ti ti-pencil-minus fs-4"></i></a>'
				button = button + '<a href="<?=base_url()?>user/hapus/'+encodeURI(btoa(full.username))+'" class="del-data btn btn-danger mx-1 my-1"><i class="ti ti-trash"></i></a>';
				return button;
			}
		}],
	});



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