<!-- Page Header -->
<div class="page-header">
	<div class="row align-items-end">
		<div class="col-sm mb-2 mb-sm-0">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-no-gutter">
					<li class="breadcrumb-item"><a class="breadcrumb-link" href="<?= site_url('admin') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Seleksi TIM</li>
				</ol>
			</nav>
			<div class="d-flex justify-content-between">
				<h1 class="page-header-title mt-3 mb-3">Seleksi TIM - Bidang Lomba <span class="badge badge-primary"><?= $bidang_lomba ?></span></h1>
				<div class="dropdown mt-2">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Bidang Lomba
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="<?= site_url('admin/seleksi/') ?>">Semua Lomba</a>
						<?php foreach ($all_bidang_lomba as $row) { ?>
							<a class="dropdown-item" href="<?= site_url('admin/seleksi/' . $row->ID_BIDANG) ?>"><?= $row->BIDANG_LOMBA ?></a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-auto">
		</div>
	</div>
	<!-- End Row -->
</div>
<!-- End Page Header -->

<form action="<?= site_url('admin/seleksi_tim');?>" method="POST" id="form-seleksi">
  	<div class="row">
  		<div class="col-4">
  			<button type="button" data-toggle="modal" data-target="#panduan-seleksi" class="btn btn-success btn-sm btn-block shadow mb-4">Panduan Seleksi</button>
  			<div class="card card-shadow">
  				<div class="card-header">
  					<h5 class="card-header-title">Pengaturan seleksi</h5>
  				</div>
  				<div class="card-body">
  					<div class="form-group">
  						<label class="input-label">Setting Tahap</label>
  						<select class="js-select2-custom custom-select" name="TAHAP" size="1" id="tahap" 
	  						data-hs-select2-options='{
	  						"minimumResultsForSearch": "Infinity",
	  						"placeholder": "Pilih Tahap"
	  					}'>
	  					<option value="0">Pilih Tahap</option>
	  						<?php if ($tahap != false) :?>
	  							<option value="0">Status Awal</option>
		  						<?php foreach ($tahap as $key) :?>
		  							<option value="<?= $key->ID_TAHAP;?>"><?= $key->NAMA_TAHAP;?></option>
		  						<?php endforeach;?>
	  						<?php else:?>
	  							<option value="0">Belum ada Tahap</option>
	  						<?php endif;?>
	  					</select>
	  				</div>
	  				<div class="form-group mb-0">
	  					<div class="media align-items-center mb-2">
	  						<span class="d-block font-size-1 mr-3">Max TIM</span>
	  						<div class="media-body text-right">
	  							<span class="text-dark font-weight-bold" id="max-tim">pilih tahap</span>
	  						</div>
	  					</div>
	  					<div class="media align-items-center mb-2">
	  						<span class="d-block font-size-1 mr-3">Status Tahap</span>
	  						<div class="media-body text-right">
	  							<span id="status-tahap">pilih tahap</span>
	  						</div>
	  					</div>
	  				</div>
	  			</div>
	  		</div>
	  	</div>
	  	<div class="col-8">
	  		<div class="card" id="daftar-tim">
	  			<div class="card-header">
	  				<h5 class="card-header-title">Daftar Tim</h5>
	  			</div>
	  			<!-- Table -->
	  			<div class="card-body" id="table-tim">
	  				<table id="myTable" class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
					  <thead class="thead-light">
					    <tr>
					      <th>No</th>
					      <th>Tim</th>
				          <th>Tahap TIM</th>
					    </tr>
					  </thead>

					  <tbody>
					    <?php
					    $no = 1;
					    foreach ($tim as $item) {

					      echo '
					      <tr>
					      <td>'.$no.'</td>
					      <td>'.$item->NAMA_TIM.'</td>
				          <td>'.($CI->M_admin->get_tahapData($item->TAHAP) == false ? "Menunggu seleksi" : $CI->M_admin->get_tahapData($item->TAHAP)->NAMA_TAHAP).'</td>
					      </tr>
					      ';
					      $no++;
					    }
					    ?>
					  </tbody>
					</table>
	  			</div>
	  			<!-- End Table -->
	  		</div>
	  	</div>
  </div>
</form>



<div class="modal fade" id="panduan-seleksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Panduan Seleksi</h5>
				<button type="button" class="btn btn-xs btn-icon btn-soft-secondary" data-dismiss="modal" aria-label="Close">
					<svg aria-hidden="true" width="10" height="10" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
						<path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
					</svg>
				</button>
			</div>
			<div class="modal-body">
				<ul class="mb-0">
					<li>Anda dapat menggunakan fitur ini untuk memilih TIM dari setiap bidang lomba, agar dapat masuk kedalam proses tahap penilaian tertentu</li>
					<li>Setiap tahap penilaian memiliki jumlah maksimal TIM yang dapat dipilih, anda dapat mengatur ini di menu <a href="<?= site_url('kompetisi/tahap-penilaian');?>">Tahap Penilaian</a></li>
					<li>Terdapat 2 jenis mode seleksi:</li>
					<ul>
						<li>A. Berdasarkan status verifikasi berkas yang telah di terima <small>(default)</small></li>
						<li>B. Berdasarkan nilai TIM <small>(jika tahap yang dipilih telah dilakukan penilaian)</small></li>
					</ul>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="seleksi-btn" tabindex="-1" aria-labelledby="mdlBayarMulti" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlBayarMulti">Bayar Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Apakah anda yakin untuk membayar transaksi untuk <span id="mdlBayarMulti_count"></span> tim tersebut  ?
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="<?= site_url('pts/order') ?>" method="post">
                    <input type="hidden" id="mdlBayarMulti_itemId" name="KODE_PENDAFTARAN" />
                    <input type="hidden" id="" name="TOTAL_TIM" value="<?= $allTim?>" />
                    <button type="submit" class="btn btn-success">Bayar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tahap').change(function(){
			if ($('#tahap').val() == 0) {
				$("#max-tim").html('Tidak terbatas');
				$("#status-tahap").html('reset ke tahap awal');
				$("#table-tim").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Memuat Data...');
				jQuery.ajax({
		            url: "<?= base_url('admin/get_seleksiTIM/'.$id_bidang.'/0/0') ?>",
		            type: "GET",
		            success: function(data) {
		                $("#daftar-tim").html(data);
		            }
		        });
			}else{
				$("#max-tim").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Memuat...');
				$("#status-tahap").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Memuat...');
				$("#table-tim").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Memuat Data...');
				jQuery.ajax({
					url: '<?= site_url('admin/get_tahapData')?>',
					data: $('#form-seleksi').serialize(),
					method: 'post',
					dataType: 'json',
					success: function(data) {
						$("#info-tahap").removeClass('d-none');
						$("#max-tim").html(data.tim);
						$("#status-tahap").html(data.status);
						var tahap = $('#tahap').val();
						jQuery.ajax({
				            url: "<?= base_url('admin/get_seleksiTIM/'.$id_bidang.'/') ?>"+data.tim+"/"+tahap,
				            type: "GET",
				            success: function(data) {
				                $("#daftar-tim").html(data);
				            }
				        });
					}
				});
			}
		});
	});
</script>