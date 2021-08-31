<!-- Card -->
<div class="card mb-4">
	<div class="card-header">
		<h5 class="card-header-title">Data pendaftaran kompetisi <?= $WEB_JUDUL;?></h5>
	</div>
	<div class="card-body">
		<?php if ($bayarGagal == true) :?>
			<div class="alert alert-danger font-size-1 mb-3">
				<p class="mb-0"><b>PERHATIAN !!</b> Pembayaran yang anda lakukan gagal! harap lakukan pembayaran lagi atau hubungi admin kami untuk konfirmasi !!</p>
			</div>
		<?php elseif ($statBayar == false):?>
			<?php if ($dibayarinUniv == true) :?>
				<div class="alert alert-info font-size-1 mb-3">
					<p class="mb-0"><b>PERHATIAN !!</b> Biaya pendaftaran anda telah di urus oleh PTS anda, harap tunggu hingga proses pembayaran selesai !!</p>
				</div>
			<?php else:?>
				<?php if ($sudahBayar == true) :?>
					<div class="alert alert-secondary font-size-1 mb-3">
						<p class="mb-0"><b>PERHATIAN !!</b> harap melanjutkan proses pembayaran anda!</p>
					</div>
				<?php else:?>
					<div class="alert alert-secondary font-size-1 mb-3">
						<p class="mb-0"><b>PERHATIAN !!</b> Anda belum dapat melakukan proses <u>Upload Karya</u>, harap menyelesaikan pembayaran administrasi terlebih dahulu!</p>
					</div>
				<?php endif;?>
			<?php endif;?>
		<?php elseif($refund != false):?>
			<div class="alert alert-light font-size-1 mb-3">
				<p class="mb-0"><b>PERHATIAN !!</b> Anda dapat melakukan refund biaya pendaftaran, dikarenakan perubahan biaya pendaftaran sesuai jumlah TIM dari PTS anda, <a href="<?= site_url('refund');?>">refund sekarang</a> !!</p>
			</div>
		<?php endif;?>

		<div class="row">
			<div class="col-12">
				<div class="mb-4">
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="media align-items-center mb-3">
								<span class="d-block font-size-1 mr-3">Bidang lomba</span>
								<div class="media-body text-right">
									<span class="text-dark font-weight-bold"><?= $dataPendaftaran->BIDANG_LOMBA;?></span>
								</div>
							</div>
							<div class="media align-items-center mb-3">
								<span class="d-block font-size-1 mr-3">Nama TIM </span>
								<div class="media-body text-right">
									<span class="text-dark font-weight-bold"><?= $dataPendaftaran->NAMA_TIM;?></span>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-6 border-left">
							<div class="media align-items-center mb-3">
								<span class="d-block font-size-1 mr-3">Asal PTS <i class="far fa-question-circle text-body ml-1" data-container="body" data-toggle="popover" data-placement="top" data-trigger="hover" title="Alamat PTS" data-content="<?= $dataPendaftaran->ALAMAT_PTS;?>"></i></span>
								<div class="media-body text-right">
									<span class="text-dark font-weight-bold"><?= $dataPendaftaran->namapt;?></span>
								</div>
							</div>
							<div class="media align-items-center mb-3">
								<span class="d-block font-size-1 mr-3">Jumlah TIM dari PTS anda <i class="far fa-question-circle text-body ml-1" data-container="body" data-toggle="popover" data-placement="top" data-trigger="hover" title="Apa ini?" data-content="Jumlah tim dari PTS anda yang telah melakukan proses pembayaran, lihat pendoman untuk info lebih lanjut."></i></span>
								<div class="media-body text-right">
									<span class="text-dark font-weight-bold"><?= $dataPendaftaran->JML_TIM;?> TIM</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="border-bottom badge-secondary mb-4 px-1 py-2">
					<div class="media align-items-center">
						<span class="d-block text-white font-size-1 mr-3">Biaya pendaftaran saat ini</span>
						<div class="media-body text-right">
							<span class="text-white font-weight-bold">Rp.<?= number_format($totBayar,0,",",".");?></span>
						</div>
					</div>
				</div>
				<div class="border-bottom mb-4">
					<label class="input-label">Status berkas keperluan <i class="far fa-question-circle text-body ml-1" data-container="body" data-toggle="popover" data-placement="top" data-trigger="hover" title="Keterangan" data-content="Keterangan mengenai, status semua berkas keperluan anda"></i></label>
					<div class="media align-items-center mb-3">
						<span class="d-block font-size-1 mr-3">Data PTS</span>
						<div class="media-body text-right">
							<?php if ($dataPendaftaran->ASAL_PTS == null || $dataPendaftaran->ALAMAT_PTS == null || $dataPendaftaran->ALAMAT_PTS == null):?>
								<span class="badge badge-secondary" type="button" data-toggle="modal" data-target="#data-pts">belum lengkap</span>
							<?php else:?>
								<span class="badge badge-success" type="button" data-toggle="modal" data-target="#data-pts">lengkap</span>
							<?php endif;?>
						</div>
					</div>
					<div class="media align-items-center mb-3">
						<span class="d-block font-size-1 mr-3">Data anggota</span>
						<div class="media-body text-right">
							<?php if ($dataAnggota == false) :?>
								<a href="<?= site_url('peserta/data-anggota');?>" class="badge badge-secondary">belum lengkap</a>
							<?php else:?>
								<a href="<?= site_url('peserta/data-anggota');?>" class="badge badge-success">lengkap</a>
							<?php endif;?>
						</div>
					</div>
					<div class="media align-items-center mb-3">
						<span class="d-block font-size-1 mr-3">Berkas TIM</span>
						<div class="media-body text-right">
							<?php if ($cekBerkas == false) :?>
								<a href="<?= site_url('peserta/berkas-kompetisi');?>" class="badge badge-secondary">belum lengkap</a>
							<?php else:?>
								<a href="<?= site_url('peserta/berkas-kompetisi');?>" class="badge badge-success">lengkap</a>
							<?php endif;?>
						</div>
					</div>
					<div class="media align-items-center mb-3">
						<span class="d-block font-size-1 mr-3">Pembayaran biaya pendaftaran</span>
						<div class="media-body text-right">

							<?php if ($bayarGagal == true) :?>
								<form action="<?= site_url('peserta/bayar_pendaftaran');?>" method="POST">
									<input type="hidden" name="KODE_PENDAFTARAN" value="<?= $dataPendaftaran->KODE_PENDAFTARAN;?>">
									<input type="hidden" name="BIAYA_TIM" value="<?= $totBayar;?>">
									<button type="submit" class="badge badge-success mb-2">
										Bayar ulang
									</button>
								</form>
							<?php elseif ($statBayar == false):?>
								<?php if($dibayarinUniv == true):?>
									<button class="badge badge-success mb-2" disabled>
										<i class="fas fa-check fa-sm mr-2"></i> sedang diproses
									</button>
								<?php else:?>
									<?php if ($sudahBayar == true) :?>
										<a href="<?= site_url('peserta/riwayat-pembayaran');?>" class="badge badge-success mb-2">
											Lanjutkan pembayaran
										</a>
									<?php else:?>
										<a href="<?= site_url('peserta/bayar_pendaftaran/'.$dataPendaftaran->KODE_PENDAFTARAN);?>" class="badge badge-success mb-2">
											Bayar biaya pendaftaran
										</a>
									<?php endif;?>
								<?php endif;?>
							<?php else:?>
								<button class="badge badge-success mb-2">
									<i class="fas fa-check fa-sm mr-2"></i> sudah dibayar
								</button>
							<?php endif;?>
						</div>
					</div>
					<div class="media align-items-center mb-3">
						<span class="d-block font-size-1 mr-3">Upload Karya</span>
						<div class="media-body text-right">
							<a href="<?= site_url('peserta/upload-karya');?>" class="badge badge-secondary">belum lengkap</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- MODAL -->
<div class="modal fade" id="data-pts" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="data-anggotaLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="data-anggotaLabel">Data PTS TIM <?= $dataPendaftaran->NAMA_TIM;?></h5>
				<button type="button" class="btn btn-xs btn-icon btn-soft-secondary" data-dismiss="modal" aria-label="Close">
					<svg aria-hidden="true" width="10" height="10" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
						<path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
					</svg>
				</button>
			</div>
			<form action="<?= site_url('peserta/update_pts');?>" method="POST">
				<input type="hidden" name="KODE_PENDAFTARAN" value="<?= $dataPendaftaran->KODE_PENDAFTARAN;?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label class="input-label font-weight-bold">Asal PTS <small class="text-danger">*</small></label>
								<select class="js-custom-select custom-select" name="ASAL_PTS" size="1" data-hs-select2-options='{
									"placeholder": "Pilih pts"
									}' required>
									<option value="<?= $dataPendaftaran->ASAL_PTS;?>"><?= $dataPendaftaran->namapt;?></option>
									<?php foreach ($pts as $item) :?>
										<option value="<?= $item;?>"><?= $item;?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="input-label font-weight-bold">Alamat PTS <small class="text-danger">*</small></label>
								<textarea class="form-control form-control-sm" rows="3" name="ALAMAT_PTS"><?= $dataPendaftaran->ALAMAT_PTS;?></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white btn-sm" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>