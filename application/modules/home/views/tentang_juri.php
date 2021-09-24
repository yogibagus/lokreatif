<div class="<?php if ($this->agent->is_mobile()):?>w-60<?php else:?>w-25<?php endif;?> mx-auto space-top-2 justify-content-sm-center text-center">
  <!-- Fancybox -->
  <a class="js-fancybox video-player video-player-btn media align-items-center text-dark" href="javascript:;"
     data-hs-fancybox-options='{
       "src": "//youtu.be/ycJK86f7yUY",
       "caption": "Video juri LO Kreatif 2021",
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
      Lihat video juri
    </span>
  </a>
  <!-- End Fancybox -->
</div>
<!-- Team Section -->
<div class="container space-2">
  <?php if ($bidangLomba != false) :?>
    <?php $no = 1; foreach ($bidangLomba as $key) :?>
      <div style="background: url(<?= base_url();?>assets/frontend/svg/components/abstract-shapes-<?= $no % 2 == 0 ? '19' : '9';?>.svg) center no-repeat;">

        <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-5 mb-md-9">
          <span class="d-block small font-weight-bold text-cap mb-2">Juri</span>
          <h2>Bidang lomba <?= $key->BIDANG_LOMBA;?></h2>
        </div>
        <!-- End Title -->

        <!-- Team Carousel -->
        <div class="js-slick-carousel slick slick-gutters-3 mb-5 mb-lg-3"
             data-hs-slick-carousel-options='{
               "slidesToShow": 3,
               "dots": true,
               "dotsClass": "slick-pagination d-lg-none",
               "responsive": [{
                 "breakpoint": 1200,
                   "settings": {
                     "slidesToShow": 3
                   }
                 }, {
                 "breakpoint": 992,
                 "settings": {
                   "slidesToShow": 2
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

          <?php if ($CI->M_home->get_juriLomba($key->ID_BIDANG) != false) :?>
            <?php foreach ($CI->M_home->get_juriLomba($key->ID_BIDANG) as $value) :?>
              <div class="js-slide pb-6 px-3">
                <!-- Team -->
                <img class="img-fluid w-100 rounded-lg" src="<?= base_url();?><?= $value->PROFIL != null ? 'berkas/juri/'.$value->KODE_USER.'/'.$value->PROFIL : 'assets/frontend/img/400x500/img14.jpg' ;?>" alt="<?= $value->NAMA;?>">
                <div class="card mt-n5" style="border-top-right-radius: 0px; border-top-left-radius: 0px">
                  <div class="card-body text-center">
                    <h4 class="mb-1"><?= $value->NAMA;?></h4>
                    <p class="font-size-1 mb-0"><?= ($value->PEKERJAAN != null ? $value->PEKERJAAN : '-')?></p>
                  </div>
                </div>
                <!-- End Team -->
              </div>
            <?php endforeach;?>
          <?php else:?>
            <div class="js-slide pb-6 px-3">
              <!-- Team -->
              <div class="card border">
                <div class="card-body p-2 text-center">
                  <p class="h3 text-muted font-weight-normal mb-0">belum ada juri</p>
                </div>
              </div>
              <!-- End Team -->
            </div>
          <?php endif;?>
        </div>
        <!-- End Team Carousel -->
        <hr>
      </div>
    <?php $no++; endforeach;?>
  <?php endif;?>
</div>
<!-- End Team Section -->