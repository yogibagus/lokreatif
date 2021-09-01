<!-- Hero Section -->
<div class="container space-top-2">
  <div class="row justify-content-lg-between align-items-lg-center">
    <div class="col-sm-10 col-lg-5 mb-7 mb-lg-0">
      <img class="img-fluid" src="<?= base_url();?>assets/illustration_teamwork.png" alt="<?= $WEB_JUDUL;?>">
    </div>

    <div class="col-lg-6">
      <div class="mb-4">
        <h1 class="display-5 mb-3">
          Kompetisi NASIONAL
          <br>
          <span class="text-info font-weight-bold">
            <span class="js-text-animation"
              data-hs-typed-options='{
              "strings": [ "ide bisnis", "desain poster", "game mobile", "video pendek", "tiktok" ],
              "typeSpeed": 90,
              "loop": true,
              "backSpeed": 30,
              "backDelay": 2500
            }'></span>
          </span>
        </h1>
        <p class=""><?= $WEB_DESKRIPSI;?></p>
      </div>
    </div>
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


<?php if($kegiatan != false):?>
  <!-- Popular Categories Section -->
  <div class="space-bottom-2" style="background: url(<?= base_url();?>assets/frontend/svg/components/abstract-shapes-9.svg) center no-repeat;">
    <div class="position-relative">
      <div class="container space-2">
        <!-- Title -->
        <div class="row align-items-md-center mb-7">
          <div class="col-md-6 mb-4 mb-md-0">
            <h2>Daftar kegiatan.</h2>
          </div>
          <div class="col-md-6 text-md-right">
          </div>
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
<div class="container space-2">
  <!-- Title -->
  <div class="w-md-80 w-lg-60 text-center mx-md-auto mb-6">
    <h2>Co-Host</h2>
  </div>
  <!-- End Title -->

  <!-- Clients -->
  <div class="row justify-content-sm-center text-center">
    <div class="col-4 col-sm-2 mb-7">
      <img class="max-w-11rem max-w-md-13rem mx-auto" src="<?= base_url();?>assets/frontend/svg/clients-logo/slack.svg" alt="Image Description">
    </div>
  </div>
  <!-- End Clients -->
</div>
<!-- End Clients Section -->

<!-- Clients Section -->
<div class="container space-2">
  <!-- Title -->
  <div class="w-md-80 w-lg-60 text-center mx-md-auto mb-6">
    <h2>Media Partners</h2>
  </div>
  <!-- End Title -->

  <!-- Clients -->
  <div class="row justify-content-sm-center text-center">
    <div class="col-4 col-sm-2 mb-7">
      <img class="max-w-11rem max-w-md-13rem mx-auto" src="<?= base_url();?>assets/frontend/svg/clients-logo/slack.svg" alt="Image Description">
    </div>
  </div>
  <!-- End Clients -->
</div>
<!-- End Clients Section -->

<!-- Clients Section -->
<div class="container space-2 space-bottom-2">
  <!-- Title -->
  <div class="w-md-80 w-lg-60 text-center mx-md-auto mb-6">
    <h2>Industry Partners</h2>
  </div>
  <!-- End Title -->

  <!-- Clients -->
  <div class="row justify-content-sm-center text-center">
    <div class="col-4 col-sm-2 mb-7">
      <img class="max-w-11rem max-w-md-13rem mx-auto" src="<?= base_url();?>assets/frontend/svg/clients-logo/slack.svg" alt="Image Description">
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