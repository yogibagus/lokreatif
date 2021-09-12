<!-- Breadcrumb Section -->
<div class="bg-dark" style="background-image: url(<?= base_url();?>assets/frontend/svg/components/abstract-shapes-20.svg);">
  <div class="container space-3 space-top-lg-3 space-bottom-lg-3">
    <div class="row align-items-center">
      <div class="col">
        <div class="d-none d-lg-block">
          <h1 class="h2 text-white"><?= ($this->uri->segment(1) ? ucwords(str_replace('-', ' ', $this->uri->segment(1))) : 'APTISI 7 JATIM');?></h1>
        </div>

        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-light breadcrumb-no-gutter mb-0">
          <li class="breadcrumb-item">Pengguna</li>
          <li class="breadcrumb-item <?= (empty($this->uri->segment(2)) ? "active" : "") ?>">Dashboard</li>
          <?php if(!empty($this->uri->segment(2))): ?>
            <li class="breadcrumb-item active" aria-current="page"><?= ($this->uri->segment(2) ? ucwords(str_replace('-', ' ', $this->uri->segment(2))) : '');?></li>
          <?php endif; ?>
        </ol>
        <!-- End Breadcrumb -->
      </div>

      <div class="col-auto">
        <!-- Responsive Toggle Button -->
        <button type="button" class="navbar-toggler btn btn-icon btn-sm rounde-circle d-lg-none"
        aria-label="Toggle navigation"
        aria-expanded="false"
        aria-controls="sidebarNav"
        data-toggle="collapse"
        data-target="#sidebarNav">
        <span class="navbar-toggler-default">
          <svg width="14" height="14" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
            <path fill="currentColor" d="M17.4,6.2H0.6C0.3,6.2,0,5.9,0,5.5V4.1c0-0.4,0.3-0.7,0.6-0.7h16.9c0.3,0,0.6,0.3,0.6,0.7v1.4C18,5.9,17.7,6.2,17.4,6.2z M17.4,14.1H0.6c-0.3,0-0.6-0.3-0.6-0.7V12c0-0.4,0.3-0.7,0.6-0.7h16.9c0.3,0,0.6,0.3,0.6,0.7v1.4C18,13.7,17.7,14.1,17.4,14.1z"/>
          </svg>
        </span>
        <span class="navbar-toggler-toggled">
          <svg width="14" height="14" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
            <path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
          </svg>
        </span>
      </button>
      <!-- End Responsive Toggle Button -->
    </div>
  </div>
</div>
</div>
<!-- End Breadcrumb Section -->

<!-- Content Section -->
<div class="container space-1 space-top-lg-0 space-bottom-lg-2 mt-lg-n10">
  <div class="row">
    <div class="col-lg-12">
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
								<label for="NamaDospem" class="input-label font-weight-bold">Nama <b>Dosen Pembimbing</b> <small class="text-danger">*</small></label>
								<input type="text" class="form-control form-control-sm" name="NAMA_DOSPEM" id="NamaDospem" value="<?= $dataDospem != false ? $dataDospem->NAMA : '' ;?>" required>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="EmailDospem" class="input-label font-weight-bold">EMAIL <small class="text-danger">*</small></label>
								<div class="d-flex">
									<input type="email" class="form-control form-control-sm" name="EMAIL_DOSPEM" id="EmailDospem" value="<?= $dataDospem != false ? $dataDospem->EMAIL : '' ;?>" required>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="NimDospem" class="input-label font-weight-bold">NIDN <small class="text-muted">(jika ada)</small></label>
								<input type="text" class="form-control form-control-sm" name="NIM_DOSPEM" id="NimDospem" value="<?= $dataDospem != false ? $dataDospem->NIM : '' ;?>">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="HPDospem" class="input-label font-weight-bold">No. Telp <small class="text-danger">*</small></label>
								<div class="d-flex">
									<input type="tel" class="form-control form-control-sm" name="HP_DOSPEM" id="HPDospem" value="<?= $dataDospem != false ? $dataDospem->HP : '' ;?>" required>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="NamaKetua" class="input-label font-weight-bold">Nama <b>KETUA</b> <small class="text-danger">*</small></label>
								<input type="text" class="form-control form-control-sm" name="NAMA_KETUA" id="NamaKetua" value="<?= $dataKetua != false ? $dataKetua->NAMA : $this->session->userdata('nama');?>" required>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="EmailKetua" class="input-label font-weight-bold">EMAIL <small class="text-danger">*</small></label>
								<div class="d-flex">
									<input type="email" class="form-control form-control-sm" name="EMAIL_KETUA" id="EmailKetua" value="<?= $this->session->userdata('email');?>" readonly>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="NimKetua" class="input-label font-weight-bold">NIM <small class="text-danger">*</small></label>
								<input type="text" class="form-control form-control-sm" name="NIM_KETUA" id="NimKetua" value="<?= $dataKetua != false ? $dataKetua->NIM : '';?>" required>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="HPKetua" class="input-label font-weight-bold">No. Telp <small class="text-danger">*</small></label>
								<div class="d-flex">
									<input type="tel" class="form-control form-control-sm" name="HP_KETUA" id="HPKetua" value="<?= $dataKetua != false ? $dataKetua->HP : '';?>" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-header border-bottom pb-2">
					<h5 class="card-header-title">Anggota TIM <i><?= $dataPendaftaran->NAMA_TIM;?></i> <small class="text-danger">max 9 anggota TIM</small></h5>
					<button type="button" class="btn btn-info btn-xs btn-sm <?= $dataAnggota != false ? (count($dataAnggota) >= 9 ? 'd-none' : '') : '';?>" id="add">Tambah field anggota</button>
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
							<div class="col-md-4">
								<div class="form-group">
									<label for="EmailAnggota<?= $no;?>" class="input-label font-weight-bold">EMAIL <small class="text-danger">*</small></label>
									<input type="email" class="form-control form-control-sm" name="EMAIL_ANGGOTA[]" id="EmailAnggota<?= $no;?>" value="<?=$anggota->EMAIL;?>" required>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="NimAnggota<?= $no;?>" class="input-label font-weight-bold">NRP/NIM <small class="text-danger">*</small></label>
									<input type="text" class="form-control form-control-sm" name="NIM_ANGGOTA[]" id="NimAnggota" value="<?= $anggota->NIM;?>" required>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="HPAnggota<?= $no;?>" class="input-label font-weight-bold">No. Telp <small class="text-danger">*</small></label>
									<div class="d-flex">
										<input type="tel" class="form-control form-control-sm" name="HP_ANGGOTA[]" id="HPAnggota<?= $no;?>" value="<?=$anggota->HP;?>" required>
										<a href="<?php echo site_url('peserta/hapus_anggota/'.$anggota->ID_ANGGOTA);?>" class="btn btn-soft-danger ml-2 btn-sm"><i class="fas fa-trash"></i></a>
									</div>
								</div>
							</div>
						</div>
						<?php $no++; endforeach;?>
					<?php endif;?>
					<?php if (($dataAnggota != false ? count($dataAnggota) : 1) <= 9) :?>
						<div id="add_anggota">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="NamaAngota" class="input-label font-weight-bold">Nama <small class="text-danger">*</small></label>
										<input type="text" class="form-control form-control-sm" name="NAMA_ANGGOTA[]" id="NamaAngota" placeholder="Masukkan Nama anggota" required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="EmailAnggota" class="input-label font-weight-bold">EMAIL <small class="text-danger">*</small></label>
											<input type="email" class="form-control form-control-sm" name="EMAIL_ANGGOTA[]" id="EmailAnggota" placeholder="Masukkan Email" required>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="NimAnggota" class="input-label font-weight-bold">NIM <small class="text-danger">*</small></label>
										<input type="text" class="form-control form-control-sm" name="NIM_ANGGOTA[]" id="NimAnggota" placeholder="NIM" required>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="HPAnggota" class="input-label font-weight-bold">No. Telp <small class="text-danger">*</small></label>
										<div class="d-flex">
											<input type="tel" class="form-control form-control-sm" name="HP_ANGGOTA[]" id="HPAnggota" placeholder="Email" required>
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
				var i=1;
				$('#add').click(function(){
					i++;
					if (i >= <?= $dataAnggota != false ? (9-count($dataAnggota)) : 9;?>) {
						$('#add').addClass('d-none'); 
					}else{
						$('#add').removeClass('d-none'); 
					}
					$('#add_anggota').append('<div class="row" id="row'+i+'"> <div class="col-md-4"> <div class="form-group"> <label for="NamaAngota" class="input-label font-weight-bold">Nama <small class="text-danger">*</small></label> <input type="text" class="form-control form-control-sm" name="NAMA_ANGGOTA[]" id="NamaAngota" placeholder="Masukkan Nama anggota" required/> </div></div><div class="col-md-4"> <div class="form-group"> <label for="EmailAnggota" class="input-label font-weight-bold">EMAIL <small class="text-danger">*</small></label> <input type="email" class="form-control form-control-sm" name="EMAIL_ANGGOTA[]" id="EmailAnggota" placeholder="Masukkan Email" required/> </div></div><div class="col-md-2"> <div class="form-group"> <label for="NimAnggota" class="input-label font-weight-bold">NIM <small class="text-danger">*</small></label> <input type="text" class="form-control form-control-sm" name="NIM_ANGGOTA[]" id="NimAnggota" placeholder="NIM" required/> </div></div><div class="col-md-2"> <div class="form-group"> <label for="HPAnggota" class="input-label font-weight-bold">No. Telp <small class="text-danger">*</small></label> <div class="d-flex"> <input type="tel" class="form-control form-control-sm" name="HP_ANGGOTA[]" id="HPAnggota" placeholder="HP" required/> <button type="button" class="btn btn-soft-danger ml-2 btn-sm btn_remove" id="'+i+'"><i class="fas fa-trash"></i></button> </div></div></div></div>');
				});
				$(document).on('click', '.btn_remove', function(){
					var button_id = $(this).attr("id");
					$('#row'+button_id+'').remove();
					i--;
					if (i >= <?= $dataAnggota != false ? (9-count($dataAnggota)) : 9;?>) {
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
						
						res.status && window.location.replace("<?= site_url('peserta/data-pendaftaran')?>")

		        		$('#send-button').prop("disabled", false);
						$('#send-button').html(
							`Simpan data`
						);				
					}
				})

		        return false;
		    });
		</script>