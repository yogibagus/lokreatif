<div class="card">
	<div class="card-header border-bottom pb-2">
		<h5 class="card-header-title" id="data-anggotaLabel">Data Ketua dan Dosen Pemimbing TIM <i><?= $dataPendaftaran->NAMA_TIM;?></i></h5>
		<a href="<?= site_url('peserta/data-pendaftaran');?>" class="btn btn-xs btn-icon btn-soft-secondary" >
			<svg aria-hidden="true" width="10" height="10" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
				<path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
			</svg>
		</a>
	</div>
	<form id="form-anggota">
		<input type="hidden" name="KODE_PENDAFTARAN" value="<?= $dataPendaftaran->KODE_PENDAFTARAN;?>">
		<div class="card-body pb-0">

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="NamaKetua" class="input-label font-weight-bold">Nama <b>KETUA</b> <small class="text-danger">*</small></label>
						<input type="text" class="form-control form-control-sm" name="NAMA_KETUA" id="NamaKetua" value="<?= $dataKetua != false ? $dataKetua->NIM : $this->session->userdata('nama');?>" required>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="NimKetua" class="input-label font-weight-bold">NIM <small class="text-danger">*</small></label>
						<input type="text" class="form-control form-control-sm" name="NIM_KETUA" id="NimKetua" value="<?= $dataKetua != false ? $dataKetua->NIM : '';?>" required>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label for="EmailKetua" class="input-label font-weight-bold">EMAIL <small class="text-danger">*</small></label>
						<div class="d-flex">
							<input type="email" class="form-control form-control-sm" name="EMAIL_KETUA" id="EmailKetua" value="<?= $this->session->userdata('email');?>" readonly>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="NamaDospem" class="input-label font-weight-bold">Nama <b>Dosen Pembimbing</b> <small class="text-danger">*</small></label>
						<input type="text" class="form-control form-control-sm" name="NAMA_DOSPEM" id="NamaDospem" value="<?= $dataDospem != false ? $dataDospem->NAMA : '' ;?>" required>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="NimDospem" class="input-label font-weight-bold">NIDN <small class="text-muted">(jika ada)</small></label>
						<input type="text" class="form-control form-control-sm" name="NIM_DOSPEM" id="NimDospem" value="<?= $dataDospem != false ? $dataDospem->NIM : '' ;?>">
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label for="EmailDospem" class="input-label font-weight-bold">EMAIL <small class="text-danger">*</small></label>
						<div class="d-flex">
							<input type="email" class="form-control form-control-sm" name="EMAIL_DOSPEM" id="EmailDospem" value="<?= $dataDospem != false ? $dataDospem->EMAIL : '' ;?>" required>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card-header border-bottom pb-2">
			<h5 class="card-header-title">Data anggota TIM <i><?= $dataPendaftaran->NAMA_TIM;?></i> <small class="text-danger">max 4 anggota TIM</small></h5>
			<button type="button" class="btn btn-info btn-xs btn-sm" id="add">Tambah field anggota</button>
		</div>
		<div class="card-body">
			<?php if ($dataAnggota != false) : ?>
				<?php $no=1; foreach ($dataAnggota as $anggota):?>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="NamaAngota<?= $no;?>" class="input-label font-weight-bold">Nama <small class="text-danger">*</small></label>
							<input type="text" class="form-control form-control-sm" name="NAMA_ANGGOTA[]" id="NamaAngota<?= $no;?>" value="<?= $anggota->NAMA;?>" required>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="NimAnggota<?= $no;?>" class="input-label font-weight-bold">NRP/NIM <small class="text-danger">*</small></label>
							<input type="text" class="form-control form-control-sm" name="NIM_ANGGOTA[]" id="NimAnggota" value="<?= $anggota->NIM;?>" required>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group">
							<label for="EmailAnggota<?= $no;?>" class="input-label font-weight-bold">EMAIL <small class="text-danger">*</small></label>
							<div class="d-flex">
								<input type="email" class="form-control form-control-sm" name="EMAIL_ANGGOTA[]" id="EmailAnggota<?= $no;?>" value="<?=$anggota->EMAIL;?>" required>
								<a href="<?php echo site_url('peserta/hapus_anggota/'.$anggota->ID_ANGGOTA);?>" class="btn btn-soft-danger ml-2 btn-sm"><i class="fas fa-trash"></i></a>
							</div>
						</div>
					</div>
				</div>
				<?php $no++; endforeach;?>
			<?php endif;?>
			<?php if (($dataAnggota != false ? count($dataAnggota) : 1) < 4) :?>
				<div id="add_anggota">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="NamaAngota" class="input-label font-weight-bold">Nama <small class="text-danger">*</small></label>
								<input type="text" class="form-control form-control-sm" name="NAMA_ANGGOTA[]" id="NamaAngota" placeholder="Masukkan Nama anggota" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="NimAnggota" class="input-label font-weight-bold">NIM <small class="text-danger">*</small></label>
								<input type="text" class="form-control form-control-sm" name="NIM_ANGGOTA[]" id="NimAnggota" placeholder="Masukkan NIM anggota" required>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label for="EmailAnggota" class="input-label font-weight-bold">EMAIL <small class="text-danger">*</small></label>
								<div class="d-flex">
									<input type="email" class="form-control form-control-sm" name="EMAIL_ANGGOTA[]" id="EmailAnggota" placeholder="Masukkan Email anggota" required>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif;?>
		</div>
		<div class="card-footer text-right">
			<a href="<?= site_url('peserta/data-pendaftaran');?>" class="btn btn-white btn-sm">Kembali</a>
			<button type="submit" class="btn btn-primary btn-sm" id="send-button">Simpan data</button>
		</div>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		// $.Toast("Terjadi Kesalahan", "Harap mengisikan data anggota dengan benar", "error", {
		// 	has_icon:true,
		// 	has_close_btn:true,
		// 	stack: true,
		// 	fullscreen:false,
		// 	timeout:8000,
		// 	sticky:false,
		// 	has_progress:true,
		// 	rtl:false,
		// });
		var i=1;
		$('#add').click(function(){
			i++;
			if (i >= <?= $dataAnggota != false ? (4-count($dataAnggota)) : 4;?>) {
				$('#add').addClass('d-none'); 
			}else{
				$('#add').removeClass('d-none'); 
			}
			$('#add_anggota').append('<div class="row" id="row'+i+'"><div class="col-md-4"><div class="form-group"><label for="NamaAngota" class="input-label font-weight-bold">Nama <small class="text-danger">*</small></label><input type="text" class="form-control form-control-sm" name="NAMA_ANGGOTA[]" id="NamaAngota" placeholder="Masukkan Nama anggota" required></div></div><div class="col-md-3"><div class="form-group"><label for="NimAnggota" class="input-label font-weight-bold">NIM <small class="text-danger">*</small></label><input type="text" class="form-control form-control-sm" name="NIM_ANGGOTA[]" id="NimAnggota" placeholder="Masukkan NIM anggota" required></div></div><div class="col-md-5"><div class="form-group"><label for="EmailAnggota" class="input-label font-weight-bold">EMAIL <small class="text-danger">*</small></label><div class="d-flex"><input type="email" class="form-control form-control-sm" name="EMAIL_ANGGOTA[]" id="EmailAnggota" placeholder="Masukkan Email anggota" required><button type="button" class="btn btn-soft-danger ml-2 btn-sm btn_remove" id="'+i+'"><i class="fas fa-trash"></i></button></div></div></div></div>');
		});
		$(document).on('click', '.btn_remove', function(){
			var button_id = $(this).attr("id");
			$('#row'+button_id+'').remove();
			i--;
			if (i >= <?= $dataAnggota != false ? (4-count($dataAnggota)) : 4;?>) {
				$('#add').addClass('d-none'); 
			}else{
				$('#add').removeClass('d-none'); 
			}
		});
	});
</script>

<script>
    $('form').submit(function(event) {
        $('#send-button').prop("disabled", true);
        // add spinner to button
        $('#send-button').html(
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
        );

		$.ajax({
			url: '<?= site_url('peserta/set_anggota')?>',
			data: $('#form-anggota').serialize(),
			method: 'post',
			dataType: 'json',
			success: function(res){
				res.status && window.location.replace("<?= site_url('peserta/data-pendaftaran')?>")

				$.Toast(res.status? "Berhasil" : "Terjadi Kesalahan", res.msg, res.status? 'success' : 'error', {
					has_icon:true,
					has_close_btn:true,
					stack: true,
					fullscreen:false,
					timeout:8000,
					sticky:false,
					has_progress:true,
					rtl:false,
				});

        		$('#send-button').prop("disabled", false);
				$('#send-button').html(
					`Simpan data`
				);				
			}
		})

        return false;
    });
	// $.validate(); 
	// $('#send-button').on('click', function(e){
	// 	// $(this).prop("disabled", true);
	// 	// $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
	// 	var form = $( "#form-anggota" );
	// 	form.validate()
	// 	alert( "Valid: " + form.valid() );
	// 	console.log(form.valid())
	// 	console.log(form.serialize())
	// 	// if(!isValid) {
	// 	// 	e.preventDefault(); //prevent the default action
	// 	// 	alert('oke')
	// 	// }else{
	// 	// 	alert('tidak')
	// 	// }
	// })
	// $(document).on('click', 'form button[type=submit]', function(e) {
	// 	var isValid = $(e.target).parents('form').isValid();
	// 	if(!isValid) {
	// 		e.preventDefault(); //prevent the default action
	// 		alert('oke')
	// 	}
	// 	alert('tidak')
	// });
</script>