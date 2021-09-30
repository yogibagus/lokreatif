<!-- Page Header -->
<div class="page-header mb-5 pb-0">
	<div class="row align-items-center">
		<div class="col-sm mb-2 mb-sm-0">
			<h1 class="page-header-title">Penilaian <?= $tahap != false ? '- Tahap '.$tahap->NAMA_TAHAP : '';?></h1>
		</div>

		<div class="col-sm-auto">
		</div>
	</div>
</div>
<!-- End Page Header -->

<?php if ($tahap == false):?>
	<!-- Card -->
	<div class="card mb-4">
		<div class="card-body">
			<div class="text-center space-1">
				<img class="avatar avatar-xl mb-3" src="<?= base_url();?>assets/backend/svg/illustrations/sorry.svg" alt="Image Description">
				<p class="card-text">Proses penilaian belum dimulai</p>
			</div>
			<!-- End Empty State -->
		</div>
	</div>

<?php else:?>

	<div class="row">
		<div class="col-3">
			<div class="card mb-4">
				<div class="card-header">
					<h5 class="card-header-title">Pilih TIM - <?= $bidang_juri;?></h5>
				</div>
				<div class="card-body p-0 overflow-auto w-100" style="max-height: 400px;">
					<table class="table">
						<?php if ($daftar_tim != false):?>
							<?php $no=1;foreach ($daftar_tim as $key):?>
								<tr class="text-body btn-tim" id="btn-<?= $key->KODE_PENDAFTARAN;?>">
									<td width="5%" class="pr-0">
										<?= $no++;?>. 
									</td>
									<td width="95%">
										<div class="text-none cursor pick-tim" id="<?= $key->KODE_PENDAFTARAN;?>">
											<div class="card-body text-right p-0">
												<span class="float-left"><?php echo $key->NAMA_TIM;?></span> <i class="tio-checkmark-circle-outlined text-white"></i>
											</div>
										</div>
									</td>
								</tr>
							<?php endforeach;?>

						<?php else:?>
							<tr class="text-body">
								<td width="105%">
									<div class="text-none cursor">
										<div class="card-body text-right p-0">
											belum ada TIM
										</div>
									</div>
								</td>
							</tr>
						<?php endif;?>
					</table>
				</div>
			</div>
		</div>
		<div class="col-9">
			    <div class="alert alert-soft-secondary alert-dismissible fade show mb-4" role="alert">
		          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		              <span aria-hidden="true">&times;</span>
		              <span class="sr-only">Close</span>
		          </button>
		          <strong>Perhatian!</strong> Harap matikan <strong>Internet Download Manager (IDM)</strong> untuk menghindari download secara otomatis.
		      </div>
			<div class="card mb-4">
				<div class="card-header">
					<h5 class="card-header-title" id="karya">Preview Karya</h5>
					<h5 class="card-header-title d-none" id="lembar">Lembar Penilaian</h5>
					<div class="text-right">
						<ul class="nav nav-segment" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="karya-tim-tab" data-toggle="pill" href="#karya-tim" role="tab" aria-controls="karya-tim" aria-selected="true">Karya TIM</a>
							</li>
							<li class="nav-item d-none" id="lembar-penilaian-btn">
								<a class="nav-link" id="lembar-penilaian-tab" data-toggle="pill" href="#lembar-penilaian" role="tab" aria-controls="lembar-penilaian" aria-selected="false">Lembar Penilaian</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="card-body">

					<!-- Tab Content -->
					<div class="tab-content">
						<div class="tab-pane fade show active" style="min-height: 250px" id="karya-tim" role="tabpanel" aria-labelledby="karya-tim-tab">
							<div class="text-center mt-lg-5 my-auto mx-lg-10">
								<img class="avatar avatar-xxl mb-3" src="<?= base_url();?>assets/backend/svg/illustrations/sorry.svg" alt="Image Description">
								<p class="card-text">Tidak ada data karya yang dapat ditampilkan. Harap pilih salah satu TIM terlebih dahulu.</p>
							</div>
						</div>

						<div class="tab-pane fade" id="lembar-penilaian" role="tabpanel" aria-labelledby="lembar-penilaian-tab">
							<form action="<?= site_url('juri/submit_nilai');?>" method="POST">
								<input type="hidden" name="KODE_PENDAFTARAN" value="0">
				               	<table class="table table-bordered">
					                <thead class="thead-light">
					                  <th width="2%">No</th>
					                  <th width="90%">Kriteria Penilaian</th>
					                  <th width="3%">Bobot</th>
					                  <th width="5%">Nilai</th>
					                </thead>
					                <tbody>
					                  	<?php $no = 1; if($dataKriteria != false): foreach($dataKriteria as $kriteria):?>
						                  <tr>
						                    <td <?= (!empty($kriteria->KETERANGAN) ? 'rowspan="2"' : '');?>>
						                    	<?= $no++;?>
						                    	<input type="hidden" class="total_nilai" name="NILAI[]" value="1" id="count_nilai-<?= $no;?>">
						                    </td>
						                    <td>
						                    	<input type="hidden" name="ID_KRITERIA[]" value="<?= $kriteria->ID_KRITERIA;?>">
						                    	<?= $kriteria->KRITERIA;?>
						                    </td>
						                    <td <?= (!empty($kriteria->KETERANGAN) ? 'rowspan="2"' : '');?>>
						                    	<input type="hidden" name="BOBOT[]" value="<?= $kriteria->BOBOT;?>" id="bobot-<?= $no;?>">
						                    	<?= $kriteria->BOBOT;?>%
						                    </td>
						                    <td <?= (!empty($kriteria->KETERANGAN) ? 'rowspan="2"' : '');?>>
						                    	<!-- Quantity Counter -->
												<div class="js-quantity-counter input-group-quantity-counter">
												  <input type="number" class="counter-<?=$no;?> form-control input-group-quantity-counter-control" value="1" min="1" max="5">

												  <div class="input-group-quantity-counter-toggle">
												    <a class="decrement-<?=$no;?> input-group-quantity-counter-btn" href="javascript:;" id="<?=$no;?>">
												      <i class="tio-remove"></i>
												    </a>
												    <a class="increment-<?=$no;?> input-group-quantity-counter-btn" href="javascript:;" id="<?=$no;?>">
												      <i class="tio-add"></i>
												    </a>
												  </div>
												</div>
												<!-- End Quantity Counter -->
						                    </td>
						                  </tr>
						                  <?php if (!empty($kriteria->KETERANGAN)):?>
							                  <tr>
							                    <td><?= $kriteria->KETERANGAN;?></td>
							                  </tr>
							              <?php endif;?>
						                  	<script type="text/javascript">
												var value<?=$no;?> = 1
												var bobot = $("#bobot-"+<?=$no;?>).val();
												var nilai = 1;
												$('.increment-'+<?=$no;?>).on("click", function() {
												  	if(value<?=$no;?> > 0 && value<?=$no;?> <5){
												    	value<?=$no;?> = parseInt(value<?=$no;?>+1);
												    	$(".counter-"+<?=$no;?>).val(value<?=$no;?>);
												  	}
												  	nilai = (bobot/100)*value<?=$no;?>;
												  	$('#count_nilai-'+<?= $no;?>).val(nilai);
												});
												$('.decrement-'+<?=$no;?>).on("click", function(){
												  	if(value<?=$no;?> > 1){
												    	value<?=$no;?> = parseInt(value<?=$no;?>-1);
												    	$(".counter-"+<?=$no;?>).val(value<?=$no;?>);
												  	}else{
												    	value<?=$no;?> = 1;
												    	$(".counter-"+<?=$no;?>).val(value<?=$no;?>);
												  	}
												  	nilai = (bobot/100)*value<?=$no;?>;
												  	$('#count_nilai-'+<?= $no;?>).val(nilai);
												});
											</script>
						                <?php endforeach; endif;?>
					              	</tbody>
					            </table>
					            <button type="button" data-toggle="modal" data-target="#submit-nilai-done" id="submit-nilai" class="btn btn-success btn-sm float-right">submit nilai</button>

						        <div class="modal fade" id="submit-nilai-done" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						            <div class="modal-dialog modal-sm" role="document">
						              <div class="modal-content">
						                <div class="modal-header">
						                  <h5 class="modal-title" id="exampleModalLabel">Kirim nilai anda</h5>
						                  <button type="button" class="btn btn-xs btn-icon btn-soft-secondary" data-dismiss="modal" aria-label="Close">
						                    <svg aria-hidden="true" width="10" height="10" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
						                      <path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
						                    </svg>
						                  </button>
						                </div>
						                <div class="modal-body">
						                    <p>Yakin kirim hasil penilaian anda terhadap tim ini, dengan total nilai <b id="total_nilai">1</b> ?</p>
						                    <div class="modal-footer px-0 pb-0">
						                      <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Batal</button>
						                      <button type="submit" class="btn btn-success btn-sm">Yakin dan kirim</button>
						                    </div>
						                </div>
						              </div>
						            </div>
						        </div>
					        </form>
						</div>
					</div>
					<!-- End Tab Content -->
				</div>
			</div>
			<div class="mb-4">
				<!-- End Nav -->
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$("#karya-tim-tab").click(function() {
			$("#karya").removeClass('d-none');
			$("#lembar").addClass('d-none');
		});
		$("#lembar-penilaian-tab").click(function() {
			$("#karya").addClass('d-none');
			$("#lembar").removeClass('d-none');
		});
		$(".input-group-quantity-counter-control").on('keydown keyup change', function(e){
		    if ($(this).val() > 5 
		        && e.keyCode !== 46 // keycode for delete
		        && e.keyCode !== 8 // keycode for backspace
		       ) {
		       e.preventDefault();
		       $(this).val(5);
		    }
		});
		const formatter = new Intl.NumberFormat('en-US', {
		   minimumFractionDigits: 2,      
		   maximumFractionDigits: 2,
		});
		$('#submit-nilai').click(function() {
			var total = 0;
			$('.total_nilai').each(function (index, element) {
		        total = total + parseFloat($(element).val());
		    });
			$("#total_nilai").html(formatter.format(total));
		});
	</script>
<?php endif;?>

<script type="text/javascript">
	$(document).ready(function() {
	    $('.pick-tim').click(function(e) {  
		    var kode = $(this).attr('id');
			$(".btn-tim").removeClass('bg-primary');
			$(".btn-tim").removeClass('text-white');
			$("input[name='KODE_PENDAFTARAN']").val(kode);
		    $("#karya-tim").html(`<center class="mt-lg-10 my-auto mx-lg-10"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sedang memuat karya...</center>`);
			jQuery.ajax({
	            url: "<?= base_url('juri/get_karyaTim/') ?>"+kode,
	            type: "GET",
	            success: function(data) {
                    $("#karya-tim").html(data);
					$("#btn-"+kode).removeClass('text-body');
					$("#btn-"+kode).addClass('text-white');
					$("#btn-"+kode).addClass('bg-primary');
					$(".input-group-quantity-counter-control").val(1);
					$("#karya-tim-tab").trigger('click');
					$("#lembar-penilaian-btn").removeClass('d-none');
	            }
            });
            console.log(kode);
	    });
	});
</script>