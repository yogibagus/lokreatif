<!-- Upload Form Section -->
<div class="container space-top-1 space-bottom-3">
	<div class="w-lg-75 mx-lg-auto">
		<!-- Title -->
		<div class="text-center mb-9">
			<h1 class="h2">Pendaftaran kompetisi <?= $WEB_JUDUL;?></h1>
			<p class="mb-0">Lengkapi data diri berikut dengan sebenar-benarnya.</p>
		</div>
		<!-- End Title -->
		<form action="<?= site_url('pendaftaran/prosesPendaftaranKompetisi');?>" method="POST" enctype="multipart/form-data">

			<div class="card card-frame card-body mb-4">
				<p class="font-size-1">Pendaftaran lomba ini menggunakan akun <?= $this->session->userdata('nama');?> -  <?= $this->session->userdata('email');?> sebagai KETUA TIM, <a href="<?= site_url('logout');?>">ganti akun?</a></p>
			</div>

			<div class="card card-frame card-body mb-4">
				<label class="input-label">Pilih bidang lomba yang diikuti <span class="text-danger">*</span></label>

				<!-- Radio Checkbox Group -->
				<div class="row mx-n2">
					<?php $no=1; foreach ($bidang_lomba as $lomba) :?>
					<div class="col-6 col-md-3 px-2 mb-3">
						<div class="custom-control custom-radio custom-control-inline checkbox-outline checkbox-icon text-center w-100 h-100">
							<input type="radio" id="radioLomba<?= $no;?>" name="BIDANG_LOMBA" value="<?= $lomba->ID_BIDANG;?>" class="custom-control-input checkbox-outline-input checkbox-icon-input" <?= $no == 1 ? 'checked' : '' ;?> >
							<label class="checkbox-outline-label checkbox-icon-label w-100 rounded py-3 px-1 mb-0" for="radioLomba<?= $no;?>">
								<img class="img-fluid w-50 mb-3" src="<?= base_url();?><?= $lomba->POSTER == null ? 'assets/frontend/svg/illustrations/discussion-scene.svg' : 'berkas/kompetisi/bidang-lomba/'.$lomba->POSTER;?>" alt="SVG">
								<span class="d-block"><?= $lomba->BIDANG_LOMBA;?></span>
							</label>
						</div>
					</div>
					<?php $no++; endforeach;?>
				</div>
				<!-- End Radio Checkbox Group -->
			</div>

			<div class="card card-frame card-body mb-4">
				<div class="form-group">
					<label class="input-label">Nama TIM<span class="text-danger">*</span></label>
					<input type="text" name="NAMA_TIM" class="form-control form-control-sm form-control-flush" placeholder="Masukkan nama tim anda" required>
				</div>
			    <!-- Form Group -->
			    <div class="form-group">
			      <label class="input-label" for="signinSrNama">Nama PTS <span class="text-danger">*</span></label>
			      <select id="select-pts" class="custom-select" data-select="listPts" size="1" style="width: 100%;"
			              data-hs-select2-options='{
			                "placeholder": "Pilih PTS"
			              }'>
			      </select>
			      <small>
			        <span class="font-size-1 text-muted">PTS anda tidak tersedia?</span>
			        <a class="font-size-1 font-weight-bold" href="<?= site_url('tambah-pts') ?>">Daftarkan PTS</a>
			      </small>
			    </div>
			    <!-- End Form Group -->
				<div class="form-group">
					<label class="input-label">Alamat PTS<span class="text-danger">*</span></label>
					<textarea type="text" name="ALAMAT_PTS" class="form-control form-control-sm form-control-flush" placeholder="Masukkan alamat pts anda" required></textarea>
				</div>
			</div>

			<!-- Divider -->
			<hr class="my-0 mb-4">
			<!-- End Divider -->


			<button class="btn btn-sm btn-primary float-right" id="send-button">Daftar</button>
		</form>
	</div>
</div>

<script type="text/javascript">
  $('#select-pts').select2({
    ajax: {
      url: '<?= site_url('ajx-data-pts-all')?>',
      dataType: 'json',
      method: 'post',
      data: params => {
        console.log(params)
        var query = {
          search: params.term,
          type: 'public'
        }
        return query;
      },
      processResults: data => {
        let arrData = [];
        for(x of data){
          temp = {id: x.kodept, text: x.namapt}
          arrData.push(temp)
        }
        return {results: arrData}
      }
    },
    placeholder: "Pilih PTS",
    // selectionCssClass: 'selectcss-custom'
  });</script>