<!-- Hero Section -->
<div class="bg-img-hero" style="background-image: url(<?= base_url();?>assets/frontend/svg/components/abstract-shapes-12.svg);">
  <div class="container space-top-2 space-bottom-2 position-relative z-index-2">
    <div class="w-md-80 w-lg-60 text-center mx-md-auto">
      <h1>Berkas LO Kreatif</h1>
      <p>Unduh berkas keperluan kompetisi <b><?= $WEB_JUDUL;?></b>.</p>
    </div>
  </div>
</div>
<!-- End Hero Section -->

<!-- FAQ Topics Section -->
<div class="container space-2" style="background: url(<?= base_url();?>assets/frontend/svg/components/abstract-shapes-9.svg) center no-repeat;">
  <div class="row center-flext justify-content-lg-center">
    <?php if ($unduhan == false) :?>
      <!-- Card -->
      <div class="card shadow-none mb-3">
        <div class="card-header card-collapse">
          <a class="btn btn-link btn-block d-flex justify-content-between card-btn bg-white px-0">
            belum ada berkas yang ditambahkan
          </a>
        </div>
      </div>
      <!-- End Card -->
    <?php else:?>
      <?php $no=1; foreach ($unduhan as $key) :?>

      <div class="col-lg-4 pt-7 mb-4 pt-lg-0">
        <!-- Card -->
        <div class="card shadow-secondary-lg p-4 p-lg-7">
          <div class="text-center mb-7">
            <h2 class="font-size-2 text-primary"><?= $key->JUDUL;?></h2>
            <span class="d-block small text-secondary font-weight-bold text-cap mb-2"><?= $key->KETERANGAN;?></span>
          </div>
          <a class="btn btn-block btn-sm btn-primary transition-3d-hover" target="_blank" href="<?= base_url();?>berkas/kebutuhan/<?= $key->LINK;?>"><i class="fas fa-download mr-2"></i> unduh berkas</a>
        </div>
        <!-- End Card -->
      </div>
      <?php $no++; endforeach;?>
    <?php endif;?>
  </div>
</div>
<!-- End FAQ Topics Section -->
