<style>
	.th-keteranga-paket {
		width: 500px;
	}
</style>

<script type="text/javascript">
    $(document).ready( function () {
        $('#table_list_paket').DataTable({
            "scrollX": true,
			"responsive": true,
			"ajax": {
				"url": "<?=base_url()?>paket/list_paket",
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
				{ data: 'namapaket' },
				{ data: 'keterangan' },
			],
            "aoColumnDefs": [{	
				"aTargets": [3],
				"mRender": function (data, type, full, meta){
					button='<a href="<?=base_url()?>paket/edit_paket/'+encodeURI(btoa(full.id))+'" class="btn btn-success m-1"><i class="ti ti-pencil-minus fs-4"></i></a>'
					button = button + '<a href="<?=base_url()?>paket/hapus/'+encodeURI(btoa(full.id))+'" class="del-data btn btn-danger m-1"><i class="ti ti-trash"></i></a>';
					return button;
				}
			}],
        });
    } );


	$(document).on("click", ".del-data", function(e){
		e.preventDefault();
		let url_href = $(this).attr('href');
		Swal.fire({
			text:"Apakah yakin menghapus data ini?",
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