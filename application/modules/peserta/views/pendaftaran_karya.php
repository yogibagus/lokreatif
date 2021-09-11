<!-- Card -->
<div class="card">
	<div class="card-header">
		<h5 class="card-header-title">Data karya TIM <?= $dataPendaftaran->NAMA_TIM;?></h5>
	</div>
	<div class="card-body">
		<div class="alert alert-info">
			<small>Unggah dan lengkapi data karya dari TIM anda. <b>PERHATIAN !!</b> jika KARYA anda BERUPA VIDEO harap unggah terlebih dahulu ke akun youtube anda, kemudian SALIN link ke form link video karya.</small>
		</div>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label class="input-label">Judul <small class="text-danger">*</small></label>
				<input type="text" name="JUDUL" class="form-control form-control-sm" placeholder="Judul karya" required>
			</div>
			<!-- Nav -->
			<div class="text-center">
			  <ul class="nav nav-segment nav-pills scrollbar-horizontal" role="tablist">
			    <li class="nav-item">
			      <a class="nav-link active" id="karya-dokumen" data-toggle="pill" href="#pills-one-code-features-example1" role="tab" aria-controls="pills-one-code-features-example1" aria-selected="true">Unggah Karya (Dokumen)</a>
			    </li>
			    <li class="nav-item">
			      <a class="nav-link" id="karya-video-tab" data-toggle="pill" href="#karya-video" role="tab" aria-controls="karya-video" aria-selected="false">Unggah Karya (Video)</a>
			    </li>
			  </ul>
			</div>
			<!-- End Nav -->

			<!-- Tab Content -->
			<div class="tab-content">
			  <div class="tab-pane fade show active" id="pills-one-code-features-example1" role="tabpanel" aria-labelledby="karya-dokumen">
				<div class="form-group">
					<label class="input-label">File Karya (dokumen) <small class="text-danger">*</small> <i class="far fa-question-circle text-body font-size-1 ml-1" data-container="body" data-toggle="popover" data-placement="top" data-trigger="hover" title="Jika karya anda dalam bentuk dokumen seperti PDF, Word, Gambar atau sebagainya"></i></label>
					<label class="btn btn-sm btn-primary transition-3d-hover file-attachment-btn" for="fileAttachmentBtn">
						<span id="customFileUpload">Tambahkan dokumen karya</span>
						<input id="fileAttachmentBtn" name="KARYA" type="file" class="js-file-attach file-attachment-btn-label" accept=".pdf,image/*"
							data-hs-file-attach-options='{
								"textTarget": "#customFileUpload",
								"maxFileSize": 10240
							}'>
					</label>
				</div>
			  </div>

			  <div class="tab-pane fade" id="karya-video" role="tabpanel" aria-labelledby="karya-video-tab">
				<div class="form-group">
					<label class="input-label">Link video Youtube <small class="text-danger">*</small> <i class="far fa-question-circle text-body font-size-1 ml-1" data-container="body" data-toggle="popover" data-placement="top" data-trigger="hover" title="Jika karya anda dalam bentuk video, maka harap unggah terlebih dahulu di akun youtube anda"></i></label>
					<input type="link" name="LINK" class="form-control form-control-sm" id="link_youtube" placeholder="Link video karya">
				</div>
			  </div>
			</div>
			<!-- End Tab Content -->
			<div class="form-group">
				<label class="input-label">Keterangan <small class="text-muted">(optional)</small></label>
				<textarea name="KETERANGAN" id="TinyMCE" class="form-control form-control-sm" rows="3"></textarea>
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