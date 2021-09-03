<!-- Card -->
<div id="display">
	<div class="card mb-4">
		<div class="card-header">
			<h5 class="card-header-title">Riwayat Pembayaran - <?= $dataPendaftaran->NAMA_TIM; ?></h5>
			<?php if ($sudahBayar == false) : ?><?php if ($payments != false):?><a href="<?= site_url('payment/checkout/'.$KODE_TRANS);?>" class="btn btn-xs btn-success float-right">Pilih metode pembayaran baru</a><?php endif ?><?php endif ?>
		</div>
		<div class="card-body">
			<?php if ($sudahBayar != false) : ?>
				<div class="alert alert-success">
					<p class="mb-0">Anda telah menyelesaikan proses pembayaran biaya pendaftaran.</p>
				</div>
			<?php endif ?>
			<table id="myTable" class="table table-stripped table-hover no-warp">
				<?php if ($payments == false):?>
					<div class="text-center space-1">
						<img class="avatar avatar-xl mb-3" src="<?= base_url();?>assets/backend/svg/illustrations/sorry.svg" alt="Image Description">
						<p class="card-text">Belum ada riwayat pembayaran</p>
					</div>
					<!-- End Empty State -->
				<?php else:?>
				<thead class="thead-light">
					<tr>
						<th>No</th>
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
							<td><?= $no++; ?></td>
							<td><?= date('d F Y H:i:s', strtotime($value->EXP_TIME)); ?></td>
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

<script type="text/javascript">
  $(document).ready(function(){
    function display(){           
      $.ajax({
        url:'<?php echo site_url('peserta/get_listPayment');?>',
        success:function(rs){
          $("#display").html(rs);
        }
      });
    }   
    setInterval(function(){
      display();
    },15000);  
  });
</script>