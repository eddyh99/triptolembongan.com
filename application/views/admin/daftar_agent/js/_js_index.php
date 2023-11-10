<script>
    $(document).ready( function () {
        $('#table_list_agent').DataTable({
            "scrollX": true,
            "aoColumnDefs": [{	
					"aTargets": [5],
					"mRender": function (){
						button='<a href="<?=base_url()?>" class="btn btn-success"><i class="ti ti-pencil-minus fs-4"></i></a>'
						button = button + '<a href="<?=base_url()?>"class="del-data btn btn-danger mx-1"><i class="ti ti-trash"></i></a>';
						return button;
					}
				}],
        });
    } );


	$(document).on("click", ".del-data", function(e){
		e.preventDefault();
		Swal.fire({
			text:"Apakah yakin menghapus data ini?",
			type: "warning",
			position: 'center',
			showCancelButton: true,
			confirmButtonText: "Hapus",
			cancelButtonText: "Batal",
			confirmButtonColor: '#D5745B',
			closeOnConfirm: true,
			showLoaderOnConfirm: true,
		}).then((result) => {
			if (result.isConfirmed) {
				Swal.fire({
					html:  `<div class="d-flex justify-content-center align-items-center">
								<div>
									<i class="ti ti-circle-check text-success fs-8"></i>
								</div>
								<div class="ms-3">Data Berhasil Dihapus</div>
							</div>`,
					showConfirmButton: false,
					background: '#F9F9F9',
					color: '#000000',
					position: 'top',
					timer: 1500,
				});
				// document.location.href = url_href;
			}
		})
	});
</script>