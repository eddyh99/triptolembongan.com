<script type="text/javascript">
    $(document).ready( function () {
        $('#table_list_agent').DataTable({
            "scrollX": true,
			"ajax": {
				"url": "<?=base_url()?>agent/list_agent",
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
				{ data: 'nama' },
				{ data: 'alamat' },
				{ data: 'kota' },
				{ data: 'kontak' },
				{ data: 'tipe' },
			],
            "aoColumnDefs": [{	
				"aTargets": [6],
				"mRender": function (data, type, full, meta){
					button='<a href="<?=base_url()?>agent/edit_agent/'+encodeURI(btoa(full.id))+'" class="btn btn-success"><i class="ti ti-pencil-minus fs-4"></i></a>'
					button = button + '<a href="<?=base_url()?>agent/hapus/'+encodeURI(btoa(full.id))+'" class="del-data btn btn-danger mx-1"><i class="ti ti-trash"></i></a>';
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