<div style="background: url(<?= base_url();?>assets/frontend/svg/components/abstract-shapes-19.svg) center no-repeat;">
  <!-- Team Section -->
  <div class="container space-2">

    <?php if ($bidangLomba != false) :?>
      <?php foreach ($bidangLomba as $key) :?>

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

      <?php endforeach;?>
    <?php endif;?>
  </div>
  <!-- End Team Section -->
</div>