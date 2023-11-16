<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- DATE PICKER -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<style>
    .select2{
        width: 100% !important;
    }

    .icon-berlaku {
        cursor: pointer;
    }
/* 
    .harga-show {
        color: red;
    } */
</style>


<script>
    
	$(document).ready( function () {
        $('#table_list_paket_agent').DataTable({
            "scrollX": true,
			"ajax": {
				"url": "<?=base_url()?>paket/list_paket_agent",
				"type": "POST",
				"dataSrc":function (data){
					return data;							
				}
			},
			"columns": [
				{ 	data: 'id',
					// "sortable": false, 
       				// 	render: function (data, type, row, meta) {
                 	// 	return meta.row + meta.settings._iDisplayStart + 1;
                	// }
				},
				{ data: 'namapaket' },
				{ data: 'keterangan' },
				{ data: 'nama' },
				{ data: 'kontak' },
				{ data: 'harga', render: $.fn.dataTable.render.number(',', '.',0, '')},
			],
            "aoColumnDefs": [{	
				"aTargets": [6],
				"mRender": function (data, type, full, meta){
					button='<a href="<?=base_url()?>paket/edit_paket_agent/'+encodeURI(btoa(full.id))+'" class="btn btn-success">'+full.id+'<i class="ti ti-pencil-minus fs-4"></i></a>'
					// button = button + '<a href="<?=base_url()?>ticket/hapus/'+encodeURI(btoa(full.id))+'" class="del-data btn btn-danger mx-1"><i class="ti ti-trash"></i></a>';
					return button;
				}
			}],
        });
    });

    $(document).ready(function() {

        $('.nama-agent').select2({
            placeholder: "Nama Agent",
            allowClear: true,
            theme: "bootstrap",
        });

        $('.paket').select2({
            placeholder: "Paket",
            allowClear: true,
            theme: "bootstrap",
        });

    });
    $(function() {
            $( "#berlaku" ).datepicker({
                dateFormat: 'dd-mm-yy',
                // timeFormat:  "hh:mm:ss",
                changeYear: true,
                changeMonth: true,
                minDate: 0,
                yearRange: "-100:+20",
            });
        });
</script>