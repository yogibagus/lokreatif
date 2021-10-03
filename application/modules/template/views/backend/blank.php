<!-- JS Implementing Plugins -->
<script src="<?= base_url();?>assets/backend/js/vendor.min.js"></script>


<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<?php $this->load->view($module.'/'.$fileview); ?>
<script>

	$(document).on('ready', function () {


		$('#myTable2').DataTable( {
			"language": {
				"emptyTable": '<div class="text-center p-4">' +
				'<img class="mb-3" src="<?= base_url() ?>assets/backend/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
				'<p class="mb-0">Tidak ada data untuk ditampilkan</p>' +
				'</div>'
			},
			"scrollX": true
		} );
	});
</script>