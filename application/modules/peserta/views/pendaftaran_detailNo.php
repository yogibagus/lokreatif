<!-- Card -->
<div class="card mb-4">
	<div class="card-header">
		<h5 class="card-header-title">Data pendaftaran kompetisi <?= $WEB_JUDUL;?></h5>
	</div>
	<div class="card-body">
		<div class="text-center space-1">
			<img class="avatar avatar-xl mb-3" src="<?= base_url();?>assets/backend/svg/illustrations/sorry.svg" alt="Image Description">
			<p class="card-text">Anda belum mendaftarkan TIM anda pada lomba LO Kreatif. <a href="<?= site_url('daftar-kompetisi');?>" class="text-primary">daftarkan tim anda</a></p>
		</div>
		<!-- End Empty State -->
	</div>
</div>