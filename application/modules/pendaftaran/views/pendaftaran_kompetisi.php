<!-- Upload Form Section -->
<div class="container space-top-1 space-bottom-3">
	<div class="w-lg-75 mx-lg-auto">
		<!-- Title -->
		<div class="text-center mb-9">
			<h1 class="h2">Pendaftaran kompetisi <?= $WEB_JUDUL;?></h1>
			<p class="mb-0">Lengkapi data diri berikut dengan sebenar-benarnya.</p>
		</div>
		<!-- End Title -->
		<form action="<?= site_url('pendaftaran/prosesPendaftaran/kompetisi');?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="KODE_KEGIATAN" value="lokreatif">

			<div class="card card-frame card-body mb-4">
				<p class="font-size-1">Pendaftaran menggunakan akun anda <?= $this->session->userdata('nama');?> -  <?= $this->session->userdata('email');?>, ubah data diri? <a href="<?= site_url('peserta/pengaturan');?>">ubah</a></p>
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
				<div class="form-group">
					<label class="input-label">Asal PTS<span class="text-danger">*</span></label>

					<select class="js-custom-select custom-select" name="ASAL_PTS" size="1"
						data-hs-select2-options='{
							"placeholder": "Pilih pts"
						}' required>
						<option value="">Pilih pts</option>
						<?php foreach ($pts as $item) :?>
							<option value="<?= $item;?>"><?= $item;?></option>
						<?php endforeach;?>
					</select>
					<small>
						<span class="font-size-1 text-muted">PTS anda tidak tersedia?</span>
						<a class="font-size-1 font-weight-bold" href="<?= site_url('tambah-pts') ?>">Daftarkan PTS</a>
					</small>
				</div>
				<div class="form-group">
					<label class="input-label">Alamat PTS<span class="text-danger">*</span></label>
					<textarea type="text" name="ALAMAT_PTS" class="form-control form-control-sm form-control-flush" placeholder="Masukkan alamat pts anda" required></textarea>
				</div>
			</div>

			<!-- Divider -->
			<hr class="my-0 mb-4">
			<!-- End Divider -->

			<!-- META FORM -->
			<?php $no= 1; foreach ($formulir as $key) :?>
				<?php if ($key->TYPE == "TEXT") :?>
					<input type="hidden" name="ID_FORM[]" value="<?= $key->ID_FORM;?>">
					<input type="hidden" name="TYPE[]" value="<?= $key->TYPE;?>">

					<div class="card card-frame card-body mb-4">
						<label class="input-label"><?= $key->PERTANYAAN;?> <?php if($key->REQUIRED == true):?><span class="text-danger">*</span><?php endif;?></label>
						<input class="form-control form-control-sm form-control-flush" type="text" name="JAWABAN[]" placeholder="Jawaban anda" <?= $key->REQUIRED == true ? 'required' : '';?>>
						<?php if (isset($key->KETERANGAN) || $key->KETERANGAN != null):?>
							<small class="text-muted mt-2"><?= $key->KETERANGAN;?></small>
						<?php endif;?>
					</div>

				<?php elseif ($key->TYPE == "TEXTAREA") :?>
					<input type="hidden" name="ID_FORM[]" value="<?= $key->ID_FORM;?>">
					<input type="hidden" name="TYPE[]" value="<?= $key->TYPE;?>">

					<div class="card card-frame card-body mb-4">
						<label class="input-label"><?= $key->PERTANYAAN;?> <?php if($key->REQUIRED == true):?><span class="text-danger">*</span><?php endif;?></label>
						<textarea class="form-control form-control-sm form-control-flush" type="text" name="JAWABAN[]" placeholder="Jawaban anda" <?= $key->REQUIRED == true ? 'required' : '';?>></textarea>
						<?php if (isset($key->KETERANGAN) || $key->KETERANGAN != null):?>
							<small class="text-muted mt-2"><?= $key->KETERANGAN;?></small>
						<?php endif;?>
					</div>

				<?php elseif ($key->TYPE == "FILE") :?>
					<input type="hidden" name="ID_FORM_FILE[]" value="<?= $key->ID_FORM;?>">
					<input type="hidden" name="TYPE[]" value="<?= $key->TYPE;?>">
					<input type="hidden" name="FILE_SIZE[]" value="<?= $key->FILE_SIZE;?>">

					<div class="card card-frame card-body mb-4">
						<label class="input-label"><?= $key->PERTANYAAN;?> <?php if($key->REQUIRED == true):?><span class="text-danger">*</span><?php endif;?></label>
						<div>

							<label class="btn btn-sm btn-primary transition-3d-hover file-attachment-btn" for="fileAttachmentBtn">
								<span id="customFileUpload<?= $no;?>">Tambahkan file</span>
								<input id="fileAttachmentBtn" name="JAWABAN[]" type="file" class="js-file-attach file-attachment-btn-label"
								data-hs-file-attach-options='{
								"textTarget": "#customFileUpload<?= $no;?>"
							}' <?= $key->REQUIRED == true ? 'required' : '';?>>
						</label>
					</div>
					<?php if (isset($key->KETERANGAN) || $key->KETERANGAN != null):?>
						<small class="text-muted mt-2">Ukuran file <?= $key->FILE_SIZE;?> MB. <?= $key->KETERANGAN;?></small>
					<?php endif;?>
				</div>

				<?php elseif ($key->TYPE == "RADIO") :?>
					<input type="hidden" name="ID_FORM[]" value="<?= $key->ID_FORM;?>">
					<input type="hidden" name="TYPE[]" value="<?= $key->TYPE;?>">

					<div class="card card-frame card-body mb-4">
						<label class="input-label"><?= $key->PERTANYAAN;?> <?php if($key->REQUIRED == true):?><span class="text-danger">*</span><?php endif;?></label>

						<?php if ($CI->General->get_formItem($key->ID_FORM) == false) :?>
							<p class="text-danger"><i>Belum ada item pilihan</i></p>
						<?php else: ?>
							<!-- Input Group -->
							<div class="input-group input-group-down-break" style="max-width: 18rem;">

								<?php $radio = 1; foreach ($CI->General->get_formItem($key->ID_FORM) as $item) :?>					<!-- Custom Radio -->
								<div class="form-control form-control-sm">
									<div class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" name="JAWABAN[]" id="radioItem<?= $item->ID_FORM;?><?= $radio;?>" value="<?= $item->ITEM;?>" <?= $radio == 1 ? 'checked' : '';?>>
										<label class="custom-control-label" for="radioItem<?= $item->ID_FORM;?><?= $radio;?>"><?= $item->ITEM;?></label>
									</div>
								</div>
								<!-- End Custom Radio -->
								<?php $radio++; endforeach;?>

							</div>
						<?php endif;?>

						<?php if (isset($key->KETERANGAN) || $key->KETERANGAN != null):?>
							<small class="text-muted mt-2"><?= $key->KETERANGAN;?></small>
						<?php endif;?>
					</div>

				<?php elseif ($key->TYPE == "CHECK") :?>
					<input type="hidden" name="ID_FORM[]" value="<?= $key->ID_FORM;?>">
					<input type="hidden" name="TYPE[]" value="<?= $key->TYPE;?>">

					<div class="card card-frame card-body mb-4">
						<label class="input-label"><?= $key->PERTANYAAN;?> <?php if($key->REQUIRED == true):?><span class="text-danger">*</span><?php endif;?></label>

						<?php if ($CI->General->get_formItem($key->ID_FORM) == false) :?>
							<p class="text-danger"><i>Belum ada item pilihan</i></p>
						<?php else: ?>
							<?php $check = 1; foreach ($CI->General->get_formItem($key->ID_FORM) as $item) :?>
							<div class="form-group">
								<!-- Checkbox -->
								<div class="custom-control custom-checkbox">
									<input type="checkbox" id="checkItem<?= $check;?>" class="custom-control-input">
									<label class="custom-control-label" for="checkItem<?= $check;?>"><?= $item->ITEM;?></label>
								</div>
								<!-- End Checkbox -->
							</div>
							<?php $check++; endforeach;?>
						<?php endif;?>

						<?php if (isset($key->KETERANGAN) || $key->KETERANGAN != null):?>
							<small class="text-muted mt-2"><?= $key->KETERANGAN;?></small>
						<?php endif;?>
					</div>

				<?php elseif ($key->TYPE == "SELECT") :?>
					<input type="hidden" name="ID_FORM[]" value="<?= $key->ID_FORM;?>">
					<input type="hidden" name="TYPE[]" value="<?= $key->TYPE;?>">

					<div class="card card-frame card-body mb-4">
						<label class="input-label"><?= $key->PERTANYAAN;?> <?php if($key->REQUIRED == true):?><span class="text-danger">*</span><?php endif;?></label>

						<select class="js-custom-select custom-select form-control-sm custom-select-flush" name="JAWABAN[]" size="1"
						data-hs-select2-options='{
							"minimumResultsForSearch": "Infinity",
							"dropdownAutoWidth": true,
							"width": "auto"

						}'>
						<?php if ($CI->General->get_formItem($key->ID_FORM) == false) :?>
							<option value="null">Tidak ada pilihan</option>
						<?php else: ?>
							<?php foreach ($CI->General->get_formItem($key->ID_FORM) as $item) :?>
								<option value="<?= $item->ITEM;?>"><?= $item->ITEM;?></option>
							<?php endforeach;?>
						<?php endif;?>
						</select>

						<?php if (isset($key->KETERANGAN) || $key->KETERANGAN != null):?>
							<small class="text-muted mt-2"><?= $key->KETERANGAN;?></small>
						<?php endif;?>
					</div>

				<?php endif;?>
			<?php $no++; endforeach;?>

			<button class="btn btn-sm btn-primary float-right" id="send-button">Kirim formulir</button>
			<small class="text-muted">Jangan pernah mengirimkan sandi melalui Formulir.</small>
		</form>
	</div>
</div>

<script>
	$('form').submit(function(event) {
		$('#send-button').prop("disabled", true);
	    // add spinner to button
	    $('#send-button').html(
    	`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
    	);
    	return;
    });
</script>