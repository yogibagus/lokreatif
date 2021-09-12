<!-- Card -->
<div class="card">
	<div class="card-header">
		<h5 class="card-header-title">Data karya TIM <?= $dataPendaftaran->NAMA_TIM;?> - <?= $dataPendaftaran->BIDANG_LOMBA;?></h5>
	</div>
	<div class="card-body">
		<div class="alert alert-info">
			<small>Unggah dan lengkapi data karya dari TIM anda. <b>PERHATIAN !!</b> jika KARYA anda BERUPA VIDEO harap unggah terlebih dahulu ke akun youtube anda, kemudian SALIN link ke form link video karya.</small>
		</div>
		<form action="<?= site_url('peserta/kelola_karya');?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="KODE_PENDAFTARAN" value="<?= $dataPendaftaran->KODE_PENDAFTARAN;?>">
			<input type="hidden" name="BIDANG_LOMBA" value="<?= $dataPendaftaran->BIDANG_LOMBA;?>">
			<input type="hidden" name="NAMA_TIM" value="<?= $dataPendaftaran->NAMA_TIM;?>">
			<div class="form-group">
				<label class="input-label">Judul <small class="text-danger">*</small></label>
				<input type="text" name="JUDUL" class="form-control form-control-sm" value="<?= $dataKarya != false ? $dataKarya->JUDUL : '' ;?>" required>
			</div>

			<!-- Tab Content -->
			<div class="form-group">
				<label class="input-label">File Karya (dokumen) <small class="text-danger">*</small> <i class="far fa-question-circle text-body font-size-1 ml-1" data-container="body" data-toggle="popover" data-placement="top" data-trigger="hover" title="Jika karya anda dalam bentuk dokumen seperti PDF, Word, Gambar atau sebagainya"></i></label>
				<label class="btn btn-sm btn-primary transition-3d-hover file-attachment-btn" for="fileAttachmentBtn">
					<span id="customFileUpload"><?= $dataKarya != false ? $dataKarya->FILE != null ? $dataKarya->FILE : 'Tambahkan dokumen karya' : 'Tambahkan dokumen karya' ;?></span>
					<input id="fileAttachmentBtn" name="KARYA" type="file" class="js-file-attach file-attachment-btn-label" accept=".pdf,image/*"
					data-hs-file-attach-options='{
						"textTarget": "#customFileUpload",
						"maxFileSize": 10240
					}'>
				</label>
				<script type="text/javascript">
					$('#fileAttachmentBtn').change(function() {
						var file = $('#fileAttachmentBtn')[0].files[0].name;
						$('#customFileUpload').text(file);
					});
				</script>
			</div>
			<div class="form-group">
				<label class="input-label">Link video Youtube <small class="text-danger">*</small> <i class="far fa-question-circle text-body font-size-1 ml-1" data-container="body" data-toggle="popover" data-placement="top" data-trigger="hover" title="Jika karya anda dalam bentuk video, maka harap unggah terlebih dahulu di akun youtube anda"></i></label>
				<input type="link" name="LINK" class="form-control form-control-sm" id="link_youtube" value="<?= $dataKarya != false ? $dataKarya->LINK : '' ;?>">
			</div>
			<!-- End Tab Content -->
			<div class="form-group">
				<label class="input-label">Keterangan <small class="text-muted">(optional)</small></label>
				<textarea name="KETERANGAN" class="form-control form-control-sm" rows="3"><?= $dataKarya != false ? $dataKarya->KETERANGAN : '' ;?></textarea>
			</div>
			<div class="modal-footer px-0">
				<a href="<?= site_url('peserta/data-pendaftaran');?>" class="btn btn-white btn-sm">Kembali</a>
				<button type="submit" class="btn btn-primary btn-sm">Simpan data</button>
			</div>
		</form>
	</div>
</div>
<!-- End Card -->


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