<div class="card mb-4">
	<div class="card-header">
		<h5 class="card-header-title">Riwayat Pembayaran - <?= $dataPendaftaran->NAMA_TIM; ?></h5>
		<?php if ($sudahBayar == false) : ?><?php if ($payments != false):?><a href="<?= site_url('payment/checkout/'.$KODE_TRANS);?>" class="btn btn-xs btn-success float-right">Pilih metode pembayaran baru</a><?php endif ?><?php endif ?><?php if ($sudahBayar != false) : ?><a href="<?= site_url('payment/invoice/'.$KODE_TRANS);?>" class="btn btn-xs btn-secondary float-right">Invoice</a><?php endif ?>
	</div>
	<div class="card-body">
		<?php if ($sudahBayar != false) : ?>
			<div class="alert alert-success">
				<p class="mb-0">Anda telah menyelesaikan proses pembayaran biaya pendaftaran.</p>
			</div>
		<?php endif ?>
        <div class="table-responsive">
            <table id="myTable" class="table table-borderless table-thead-bordered table-nowrap table-align-middle">
				<?php if ($payments == false):?>
					<div class="text-center space-1">
						<img class="avatar avatar-xl mb-3" src="<?= base_url();?>assets/backend/svg/illustrations/sorry.svg" alt="Image Description">
						<p class="card-text">Belum ada riwayat pembayaran</p>
					</div>
					<!-- End Empty State -->
				<?php else:?>
				<thead class="thead-light">
					<tr>
						<th>Kode Transaksi</th>
						<th>Tanggal Exp.</th>
						<th>Metode</th>
						<th>Nominal</th>
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
							<td><span class="text-primary"><?= $value->KODE_TRANS; ?></span></td>
							<td><?= date('d F Y - H:i:s', strtotime($value->EXP_TIME)); ?></td>
							<td><img style="max-width: 50px;" class="img-fluid w-90 fit-image" src="<?= $value->IMG_PAY_METHOD ?>"></td>
							<td>Rp.<?= number_format($value->PAID_AMOUNT,0,",","."); ?></td>
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
				<?php endif; ?>
			</table>
		</div>
	</div>
</div>
<?php if ($sudahBayar == false || $payments != false):?>
<script type="text/javascript">
  $(document).ready(function(){
      function checkPayment() {
        setInterval(function() {
            // this code runs every second 
            jQuery.ajax({
                url: "<?= base_url('payment/check_payment/'.$KODE_TRANS) ?>",
                type: "GET",
                success: function(data) {
                    if (data == 1) {
					    display();
                    	console.log("success");
                    } else if (data == "failed") {
					    display();
                    	console.log("failed");
                    }
                }
            });
        }, 6000);
    }
  });
</script>
<?php endif ?>