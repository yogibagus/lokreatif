<!-- Card -->
<div class="card mb-4">
	<div class="card-header">
		<h5 class="card-header-title">Riwayat Pembayaran - <?= $dataPendaftaran->NAMA_TIM; ?></h5>
	</div>
	<div class="card-body">
		<?php if ($sudahBayar == false) : ?>
			<div class="alert alert-light">
				<p class="mb-0">Anda memiliki pembayaran yang belum selesai, harap lanjutkan pembayaran dengan memilih salah satu riwayat dibawah ini !! atau anda dapat memilih <i>metode pembayaran lainnya</i>. <br><a href="<?= site_url('payment/checkout/'.$KODE_TRANS);?>" class="text-primary text-highlight-primary">Pilih metode pembayaran baru</a>?</p>
			</div>
		<?php else : ?>
			<div class="alert alert-success">
				<p class="mb-0">Anda telah menyelesaikan proses pembayaran biaya pendaftaran, berikut riwayat pembayaran anda !!</p>
			</div>
		<?php endif ?>
		<table class="table table-bordered table-hover">
			<thead class="thead-light">
				<tr>
					<th>No</th>
					<th>Tanggal</th>
					<th>Metode</th>
					<th>Status</th>
					<?php if ($sudahBayar == false) : ?>
						<th></th>
					<?php endif; ?>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				foreach ($payments as $value) : ?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= date('d M Y H:i:s', strtotime($value->CREATED_TIME)); ?></td>
						<td><span class="badge badge-info"><?= $value->METHOD; ?></span></td>
						<?php if ($sudahBayar == false) : ?>
							<td>
								<span class="badge badge-<?= $CI->M_payment->get_status_payment_by_stat_pay($value->STAT_PAY)->COLOR_STAT_PAY; ?>"><?= $CI->M_payment->get_status_payment_by_stat_pay($value->STAT_PAY)->ALIAS_STAT_PAY; ?></span>
							</td>
							<td>
								<?php if ($value->STAT_PAY == 2) : ?>
									<a href="<?= site_url('payment/details/' . $value->KODE_PAY); ?>" class="btn btn-xs btn-success btn-block">bayar sekarang</a>
								<?php else : ?>
									<a class="btn btn-xs btn-<?= $CI->M_payment->get_status_payment_by_stat_pay($value->STAT_PAY)->COLOR_STAT_PAY; ?>"><?= $CI->M_payment->get_status_payment_by_stat_pay($value->STAT_PAY)->ALIAS_STAT_PAY; ?></a>
								<?php endif; ?>
							</td>
						<?php else : ?>
							<td>
								<span class="badge badge-<?= $CI->M_payment->get_status_payment_by_stat_pay($value->STAT_PAY)->COLOR_STAT_PAY; ?>"><?= $CI->M_payment->get_status_payment_by_stat_pay($value->STAT_PAY)->ALIAS_STAT_PAY; ?></span>
							</td>
						<?php endif; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>