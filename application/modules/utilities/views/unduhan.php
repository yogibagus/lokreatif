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
<div class="container space-2">
  <div class="row justify-content-lg-center">
    <div class="col-lg-8">
      <div id="basics" class="space-bottom-1">
        <!-- Basics Accordion -->
        <div id="basicsAccordion">
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
              <!-- Card -->
              <div class="card shadow-none mb-3">
                <div class="card-header card-collapse" id="unduhanHeading<?= $no;?>">
                  <a class="btn btn-link btn-block d-flex justify-content-between card-btn collapsed bg-white px-0" href="javascript:;" role="button" data-toggle="collapse" data-target="#unduhanCollapse<?= $no;?>" aria-expanded="false" aria-controls="unduhanCollapse<?= $no;?>">
                    <?= $key->JUDUL;?>

                    <span class="card-btn-toggle">
                      <span class="card-btn-toggle-default">&plus;</span>
                      <span class="card-btn-toggle-active">&minus;</span>
                    </span>
                  </a>
                </div>
                <div id="unduhanCollapse<?= $no;?>" class="collapse" aria-labelledby="unduhanHeading<?= $no;?>" data-parent="#basicsAccordion">
                  <div class="card-body px-0">
                    <p><?= $key->KETERANGAN;?></p>
                    <a href="<?= site_url('unduh/'.$key->JUDUL.'/'.$key->LINK);?>" target="_blank" class="btn btn-primary btn-sm btn-rounded float-right"><i class="fas fa-download mr-2"></i> unduh berkas</a>
                  </div>
                </div>
              </div>
              <!-- End Card -->
            <?php $no++; endforeach;?>
          <?php endif;?>
        </div>
        <!-- End Basics Accordion -->
      </div>
    </div>
  </div>
</div>
<!-- End FAQ Topics Section -->
