<!-- CTA Section -->
<div class="bg-primary">
  <div class="container space-2">
    <div class="row justify-content-lg-between align-items-lg-center text-center text-lg-left">
      <div class="col-lg-6 mb-5 mb-lg-0">
        <h2 class="text-white mb-0">Bidang lomba yang diperlombakan pada kompetisi kali ini</h2>
      </div>

      <div class="col-lg-5 text-lg-right">
        <a class="btn btn-light btn-wide btn-pill transition-3d-hover mx-1 mb-2" href="<?= site_url('pendaftaran');?>">Daftarkan diri sekarang!</a>
      </div>
    </div>
  </div>
</div>
<!-- End CTA Section -->

<!-- Description Section -->
<div class="container w-lg-80 space-2">
  <div class="row">
    <?php if ($bidangLomba != false) : ?>
      <?php $no=1; foreach ($bidangLomba as $value) :?>
      <div class="col-6 col-md-3 px-2 mb-3">
        <a href="<?= site_url('detail-lomba/'.$value->ID_BIDANG);?>" class="custom-control custom-radio custom-control-inline checkbox-outline checkbox-icon text-center w-100 h-100">
          <label class="checkbox-outline-label w-100 rounded py-3 px-1 mb-0">
            <img class="img-fluid w-50 mb-3" src="<?= base_url();?><?= $value->POSTER == null ? 'assets/frontend/svg/illustrations/discussion-scene.svg' : 'berkas/kompetisi/bidang-lomba/'.$value->POSTER;?>" alt="SVG">
            <span class="d-block text-muted"><?= $value->BIDANG_LOMBA;?></span>
          </label>
        </a>
      </div>
      <?php $no++; endforeach;?>
    <?php endif;?>
  </div>
</div>