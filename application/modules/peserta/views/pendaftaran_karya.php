<!-- Card -->
<div class="card">
	<div class="card-header">
		<h5 class="card-header-title">Data karya TIM <?= $dataPendaftaran->NAMA_TIM;?> - <?= $dataPendaftaran->BIDANG_LOMBA;?></h5>
	</div>
	<div class="card-body">
		<div class="alert alert-info">
			<small>Unggah dan lengkapi data karya dari TIM anda.</small>
		</div>
		<form action="<?= site_url('peserta/kelola_karya');?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="KODE_PENDAFTARAN" value="<?= $dataPendaftaran->KODE_PENDAFTARAN;?>">
			<input type="hidden" name="BIDANG_LOMBA" value="<?= $dataPendaftaran->BIDANG_LOMBA;?>">
			<input type="hidden" name="NAMA_TIM" value="<?= $dataPendaftaran->NAMA_TIM;?>">
			<div class="form-group">
				<label class="input-label">Judul <small class="text-danger">*</small></label>
				<input type="text" name="JUDUL" class="form-control form-control-sm" value="<?= $dataKarya != false ? $dataKarya->JUDUL : '' ;?>" required>
			</div>

	        <!-- PDF 1=Aplikasi, 8=Idebisnis, 10=game || JPG 4=desainposter, 9=fotografi -->
	        <?php if ($dataPendaftaran->ID_BIDANG == 1 || $dataPendaftaran->ID_BIDANG == 8 || $dataPendaftaran->ID_BIDANG == 10 || $dataPendaftaran->ID_BIDANG == 4 || $dataPendaftaran->ID_BIDANG == 9) : ?>
				<div class="form-group">
					<label class="input-label">File Karya (dokumen) <small class="text-danger">*</small> <i class="fa fa-question-circle text-muted" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Jika karya anda dalam bentuk dokumen seperti PDF atau Gambar."></i></label>
					<?php if($dataKarya != false && $dataKarya->FILE != null):?>
						<a href="<?= base_url();?>berkas/kompetisi/karya/<?= preg_replace("/[^a-zA-Z]+/", "_", $dataPendaftaran->BIDANG_LOMBA);?>/<?= preg_replace("/[^a-zA-Z]+/", "_", $dataPendaftaran->NAMA_TIM);?>_<?= $this->session->userdata('kode_user');?>/<?= $dataKarya->FILE;?>" class="btn btn-sm btn-primary transition-3d-hover" target="_blank">Cek Berkas</a>
					<?php endif;?>
					<label class="btn btn-sm btn-primary transition-3d-hover file-attachment-btn" for="fileAttachmentBtn">
						<span id="customFileUpload"><?= $dataKarya != false ? $dataKarya->FILE != null ? $dataKarya->FILE : 'Tambahkan dokumen karya' : 'Tambahkan dokumen karya' ;?></span>
						<input id="fileAttachmentBtn" name="KARYA" type="file" class="js-file-attach file-attachment-btn-label" accept=".pdf,image/*"
						data-hs-file-attach-options='{
							"textTarget": "#customFileUpload",
							"maxFileSize": 10240
						}'>
					</label>
					<br>
					<small class="text-muted">Harap unggah dokumen karya anda dalam format pdf/gambar sesuai bidang lomba anda.</small>
					<script type="text/javascript">
						$('#fileAttachmentBtn').change(function() {
							var file = $('#fileAttachmentBtn')[0].files[0].name;
							$('#customFileUpload').text(file);
						});
					</script>
				</div>
			<?php endif;?>


	        <!-- VIDEO 3=videopendek, 13=unjuktalent -->
			<?php if ($dataPendaftaran->ID_BIDANG == 3 || $dataPendaftaran->ID_BIDANG == 13) :?>
				<div class="form-group">
					<label class="input-label">Link Youtube <small class="text-danger">*</small> <i class="fa fa-question-circle text-muted" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Jika karya anda dalam bentuk video, maka harap unggah terlebih dahulu di akun youtube anda"></i></label>
					<input type="link" name="LINK" class="form-control form-control-sm" id="link_youtube" value="<?= $dataKarya != false ? $dataKarya->LINK : '' ;?>">
					<small class="text-muted">Harap unggah ke youtube anda, kemudian salin link video tersebut (pastikan link dapat dibuka). Contoh: <span class="text-primary">https://www.youtube.com/watch?v=PCGhwLRHpMo</span></small>
				</div>
				<div class="form-group">
					<label class="input-label">Link Drive <small class="text-danger">*</small> <i class="fa fa-question-circle text-muted" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Link drive folder dari karya anda"></i></label>
					<input type="link" name="LINK_DRIVE" class="form-control form-control-sm" id="link_drive" value="<?= $dataKarya != false ? $dataKarya->LINK_DRIVE : '' ;?>" required>
					<small class="text-muted">Kirimkan link drive dari arsip karya anda dan pastikan link tidak diprivate (cek panduan).</small>
				</div>
			<?php endif;?>


	        <!-- VIDEO GDRIVE 11=tiktok -->
	        <?php if ($dataPendaftaran->ID_BIDANG == 11) : ?>
				<div class="form-group">
					<label class="input-label">Link Video TIKTOK <small class="text-danger">*</small> <i class="fa fa-question-circle text-muted" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Jika karya anda dalam bentuk video, maka harap unggah terlebih dahulu di akun youtube anda"></i></label>
					<input type="link" name="LINK" class="form-control form-control-sm" id="link_youtube" value="<?= $dataKarya != false ? $dataKarya->LINK : '' ;?>">
					<small class="text-muted">Harap salin link tautan video dari karya tiktok anda. Contoh: <span class="text-primary">https://www.tiktok.com/@calligraphyti/video/7008541135027195138?is_copy_url=0&is_from_webapp=v1&sender_device=pc&sender_web_id=6891620369103898113</span></small>
				</div>
				<div class="form-group">
					<label class="input-label">Link Drive <small class="text-danger">*</small> <i class="fa fa-question-circle text-muted" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Link drive folder dari karya anda"></i></label>
					<input type="link" name="LINK_DRIVE" class="form-control form-control-sm" id="link_drive" value="<?= $dataKarya != false ? $dataKarya->LINK_DRIVE : '' ;?>" required>
					<small class="text-muted">Kirimkan link drive dari arsip karya anda dan pastikan link tidak diprivate (cek panduan).</small>
				</div>
			<?php endif;?>
			<div class="modal-footer px-0">
				<a href="<?= site_url('peserta/data-pendaftaran');?>" class="btn btn-white btn-sm">Kembali</a>
				<button type="submit" class="btn btn-primary btn-sm" id="send-button">Simpan data</button>
			</div>
		</form>
	</div>
</div>
<!-- End Card -->

<script>
    $('form').submit(function(event) {
        $('#send-button').prop("disabled", true);
        // add spinner to button
        $('#send-button').html(
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
        );
    });
</script>

<script type="text/javascript">
  // TINYMCE
  tinymce.init({
  	selector: '#TinyMCE',
  	height: 200,
  	menubar: false,
  	branding: false,
  	plugins: [
  	'lists preview',
  	'visualblocks',
  	'table paste wordcount'
  	],
  	toolbar: 'undo redo | formatselect | ' +
  	'bold italic | alignleft aligncenter ' +
  	'alignright alignjustify | bullist numlist outdent indent | ' +
  	'removeformat'
  });
</script>

<script type="text/javascript">
	$(document).ready(function () {
		$("#karya-dokumen").click(function () {
			$("#fileAttachmentBtn").prop('required',true);
			$("#link_youtube").prop('required',false);
		});

		$("#karya-video-tab").click(function () {
			$("#link_youtube").prop('required',true);
			$("#fileAttachmentBtn").prop('required',false);
		});
	});
</script>