<!-- Hero Section -->
<div class="container space-top-1">
  <div class="row justify-content-lg-between align-items-lg-center">
    <?php if ($this->agent->is_mobile()) :?>
    <div class="col-sm-12 mb-0">
      <img class="img-fluid" src="<?= base_url();?>assets/illustration_teamwork.png" alt="<?= $WEB_JUDUL;?>">
    </div>
    <div class="col-sm-12 text-center">
      <div class="mb-4">
        <small class="h5 font-weight-normal">BERBAGI INOVASI ANAK BANGSA UNTUK INDONESIA PADA KENORMALAN BARU</small>
        <h1 class="display-4 font-weight-bold mb-2 mt-3">
          <?= $WEB_JUDUL;?> <?= date("Y");?>
        </h1>
        <!-- Countdown -->
        <div class="js-countdown text-center justify-content-center row mb-1"
             data-hs-countdown-options='{
               "endDate": "2021/10/24"
             }'>
          <div class="col-2">
            <?php
            if ($days > 31): ?>
              <span class="font-size-3 text-primary font-weight-bold mb-0"><?= $days;?></span>
            <?php else:?>
              <span class="js-cd-days font-size-3 text-primary font-weight-bold mb-0"></span>
            <?php endif;?>
            <span class="h5 d-block mb-0">Days</span>
          </div>
          <div class="col-2">
            <span class="js-cd-hours font-size-3 text-primary font-weight-bold mb-0"></span>
            <span class="h5 d-block mb-0">Hours</span>
          </div>
          <div class="col-2">
            <span class="js-cd-minutes font-size-3 text-primary font-weight-bold mb-0"></span>
            <span class="h5 d-block mb-0">Mins</span>
          </div>
          <div class="col-2">
            <span class="js-cd-seconds font-size-3 text-primary font-weight-bold mb-0"></span>
            <span class="h5 d-block mb-0">Secs</span>
          </div>
        </div>
        <!-- End Countdown -->
        <p>Batas waktu pendaftaran dan unggah karya</p>
      </div>
    </div>
    <?php else:?>
    <div class="col-lg-6">
      <div class="mb-4">
        <small class="h5 font-weight-normal">BERBAGI INOVASI ANAK BANGSA UNTUK INDONESIA PADA KENORMALAN BARU</small>
        <h1 class="display-4 font-weight-bold mb-3">
          <?= $WEB_JUDUL;?> <?= date("Y");?>
        </h1>
        <!-- Countdown -->
        <div class="js-countdown row mb-1"
             data-hs-countdown-options='{
               "endDate": "2021/10/24"
             }'>
          <div class="col-2">
            <?php
            if ($days > 31): ?>
              <span class="font-size-4 text-primary font-weight-bold mb-0"><?= $days;?></span>
            <?php else:?>
              <span class="js-cd-days font-size-4 text-primary font-weight-bold mb-0"></span>
            <?php endif;?>
            <span class="h4 d-block mb-0">Days</span>
          </div>
          <div class="col-2">
            <span class="js-cd-hours font-size-4 text-primary font-weight-bold mb-0"></span>
            <span class="h4 d-block mb-0">Hours</span>
          </div>
          <div class="col-2">
            <span class="js-cd-minutes font-size-4 text-primary font-weight-bold mb-0"></span>
            <span class="h4 d-block mb-0">Mins</span>
          </div>
          <div class="col-2">
            <span class="js-cd-seconds font-size-4 text-primary font-weight-bold mb-0"></span>
            <span class="h4 d-block mb-0">Secs</span>
          </div>
        </div>
        <!-- End Countdown -->
        <p>Batas waktu pendaftaran dan unggah karya</p>
      </div>
    </div>

    <div class="col-sm-10 col-lg-6 mb-7 mb-lg-0">
      <img class="img-fluid" src="<?= base_url();?>assets/illustration_teamwork.png" alt="<?= $WEB_JUDUL;?>">
    </div>
  <?php endif;?>
  </div>
</div>
<!-- End Hero Section -->

<!-- SVG Bottom Shape -->
<figure>
  <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%" height="64px"
  viewBox="0 0 1921 273" style="margin-bottom: -8px; enable-background:new 0 0 1921 273;" xml:space="preserve">
  <polygon fill="#f9fbff" points="1921,0 0,0 0,273 "/>
</svg>
</figure>
<!-- End SVG Bottom Shape -->


<!-- Title -->
<div class="w-md-75 w-lg-50 space-top-1 text-center mx-md-auto mb-5 mb-md-9">
  <p class="text-primary mb-0">PROMOTION VIDEO</p>
  <h2 class="h2">Promotion video <?= $WEB_JUDUL;?> <?= date("Y");?></h2>
</div>
<!-- End Title -->

<div class="<?php if ($this->agent->is_mobile()):?>w-60<?php else:?>w-25<?php endif;?> mx-auto justify-content-sm-center text-center">
  <!-- Fancybox -->
  <a class="js-fancybox video-player video-player-btn media align-items-center text-dark" href="javascript:;"
     data-hs-fancybox-options='{
       "src": "//youtu.be/HyGFrCKRGKM",
       "caption": "Promotion video LO Kreatif 2021",
       "speed": 700,
       "buttons": ["fullScreen", "close"],
       "youtube": {
         "autoplay": 1
       }
     }'>
    <span class="video-player-icon shadow-soft mr-3">
      <i class="fa fa-play"></i>
    </span>
    <span class="media-body">
      See promotion video
    </span>
  </a>
  <!-- End Fancybox -->
</div>

<!-- Description Section -->
<div class="container w-lg-80 space-2">
  <div class="row center-flext">
    <?php if ($bidangLomba != false) : ?>
      <?php $no=1; foreach ($bidangLomba as $value) :?>
      <div class="col-6 col-md-3 px-2 mb-3">
        <a href="<?= site_url('detail-lomba/'.$value->ID_BIDANG);?>" class="custom-control custom-radio custom-control-inline checkbox-outline checkbox-icon text-center w-100 h-100">
          <label class="checkbox-outline-label w-100 rounded py-3 px-1 mb-0">
            <img class="img-fluid w-50 mb-3" src="<?= base_url();?><?= $value->POSTER == null ? 'assets/frontend/svg/illustrations/discussion-scene.svg' : 'berkas/kompetisi/bidang-lomba/'.$value->POSTER;?>" alt="SVG">
            <span class="d-block text-muted">(<?= $value->BIDANG_LOMBA;?>)</span>
          </label>
        </a>
      </div>
      <?php $no++; endforeach;?>
    <?php endif;?>
  </div>
</div>

<!-- Title -->
<div class="w-md-75 w-lg-50 space-top-1 text-center mx-md-auto mb-5 mb-md-9">
  <p class="text-primary mb-0">INFORMASI</p>
  <h2 class="h2">Pusat informasi <?= $WEB_JUDUL;?> <?= date("Y");?></h2>
</div>
<!-- End Title -->
  
<div class="container w-lg-80 space-bottom-2">
  <div class="row justify-content-sm-center text-center center-flext">

    <div class="col-sm-6 col-lg-3">
      <!-- Icon Blocks -->
      <a class="card h-100 mb-4 transition-3d-hover" href="<?= site_url('hubungi-kami');?>">
        <div class="card-body">
          <figure class="w-100 mb-4">
            <img class="img-fluid max-w-8rem" src="<?= base_url();?>assets/frontend/svg/icons/icon-18.svg" alt="SVG">
          </figure>
          <h4>Hubungi Kami</h4>
          <p class="font-size-1 text-body mb-0">Cari tau lebih lanjut di media sosial atau hubungi ADMIN kami</p>
        </div>
        <div class="card-footer border-0 pt-0">
          <span class="font-size-1">Labih lanjut <i class="fas fa-angle-right fa-sm ml-1"></i></span>
        </div>
      </a>
      <!-- End Icon Blocks -->
    </div>

    <div class="col-sm-6 col-lg-3">
      <!-- Icon Blocks -->
      <a class="card h-100 mb-4 transition-3d-hover" href="<?= site_url('unduhan');?>">
        <div class="card-body">
          <figure class="w-100 mb-4">
            <img class="img-fluid max-w-8rem" src="<?= base_url();?>assets/frontend/svg/icons/icon-43.svg" alt="SVG">
          </figure>
          <h4>Unduh berkas</h4>
          <p class="font-size-1 text-body mb-0">Unduh berkas kebutuhan lomba <?= $WEB_JUDUL;?> <?= date("Y");?></p>
        </div>
        <div class="card-footer border-0 pt-0">
          <span class="font-size-1">Lebih lanjut <i class="fas fa-angle-right fa-sm ml-1"></i></span>
        </div>
      </a>
      <!-- End Icon Blocks -->
    </div>

    <div class="col-sm-6 col-lg-3">
      <!-- Icon Blocks -->
      <a class="card h-100 mb-4 transition-3d-hover" href="<?= site_url('pusat-bantuan');?>">
        <div class="card-body">
          <figure class="w-100 mb-4">
            <img class="img-fluid max-w-8rem" src="<?= base_url();?>assets/frontend/svg/icons/icon-67.svg" alt="SVG">
          </figure>
          <h4>Pusat bantuan</h4>
          <p class="font-size-1 text-body mb-0">Kunjungi pusat bantuan jika anda mengalami kesulitan</p>
        </div>
        <div class="card-footer border-0 pt-0">
          <span class="font-size-1">Lebih lanjut <i class="fas fa-angle-right fa-sm ml-1"></i></span>
        </div>
      </a>
      <!-- End Icon Blocks -->
    </div>
  </div>

</div>

<?php if($kegiatan != false):?>
  <!-- Popular Categories Section -->
  <div class="space-bottom-3" style="background: url(<?= base_url();?>assets/frontend/svg/components/abstract-shapes-9.svg) center no-repeat;">
    <div class="position-relative">
      <div class="container space-2">
        <!-- Title -->
        <div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5 mb-md-9">
          <p class="text-primary mb-0">KEGIATAN</p>
          <h2 class="h2">Kegiatan <?= $WEB_JUDUL;?> <?= date("Y");?></h2>
        </div>
        <!-- End Title -->

        <div class="js-slick-carousel slick slick-equal-height slick-gutters-3 slick-center-mode-right slick-center-mode-right-offset"
          data-hs-slick-carousel-options='{
          "prevArrow": "<span class=\"fa fa-arrow-left slick-arrow slick-arrow-primary-white slick-arrow-left slick-arrow-centered-y shadow-soft rounded-circle ml-sm-n2\"></span>",
          "nextArrow": "<span class=\"fa fa-arrow-right slick-arrow slick-arrow-primary-white slick-arrow-right slick-arrow-centered-y shadow-soft rounded-circle mr-sm-2 mr-xl-4\"></span>",
          "slidesToShow": 5,
          "infinite": true,
          "responsive": [{
          "breakpoint": 1200,
          "settings": {
          "slidesToShow": 4
          }
          }, {
          "breakpoint": 992,
          "settings": {
          "slidesToShow": 3
        }
        }, {
        "breakpoint": 768,
        "settings": {
        "slidesToShow": 2
        }
        }, {
        "breakpoint": 554,
        "settings": {
        "slidesToShow": 1
        }
        }]
        }'>
        <!-- Article -->
        <?php foreach($kegiatan as $key):?>
          <article class="js-slide pt-2">
            <a class="card bg-img-hero w-100 min-h-270rem transition-3d-hover" href="<?= site_url('kegiatan/'.$key->KODE);?>" style="background-image: url(<?= base_url();?>assets/frontend/img/400x500/img14.jpg);">
              <div class="card-body">
                <span class="d-block small text-white-70 font-weight-bold text-cap mb-2"><?= date("d F Y", strtotime($key->TANGGAL));?></span>
                <h4 class="text-white"><?= $key->JUDUL;?></h4>
                <span class="badge badge-<?= $key->BAYAR == true ? 'success' : 'info';?>"><?= $key->BAYAR == true ? 'Berbayar' : 'Gratis';?></span>
              </div>
              <div class="card-footer border-0 bg-transparent pt-0">
                <span class="text-white font-size-1 font-weight-bold">Detail</span>
              </div>
            </a>
          </article>
          <!-- End Article -->
        <?php endforeach;?>
      </div>
    </div>

    <div class="w-100 w-md-65 bg-light position-absolute top-0 right-0 bottom-0 rounded-left z-index-n1"></div>
  </div>
</div>
<!-- End Popular Categories Section -->
<?php endif;?>

<!-- Clients Section -->
<div class="container space-top-3">
  <!-- Title -->
  <div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5 mb-md-9">
      <p class="text-primary mb-0">SPONSOR</p>
      <h2 class="h2">Sponsor pendukung <?= $WEB_JUDUL;?> <?= date("Y");?></h2>
    </div>
  <!-- End Title -->

  <!-- Clients -->
  <div class="row justify-content-sm-center text-center">
    <div class="col-4 col-sm-2 mb-7">
      - belum ada -
    </div>
  </div>
  <!-- End Clients -->
</div>
<!-- End Clients Section -->

<!-- SVG Top Shape -->
<figure>
  <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%" height="64px"
  viewBox="0 0 1921 273" style="margin-bottom: -8px; enable-background:new 0 0 1921 273;" xml:space="preserve">
    <polygon fill="#f9fbff" points="0,273 1921,273 1921,0 "/>
  </svg>
</figure>
<!-- End SVG Top Shape -->