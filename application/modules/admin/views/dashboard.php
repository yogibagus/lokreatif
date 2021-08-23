<!-- Page Header -->
<div class="page-header">
  <div class="row align-items-center">
    <div class="col-sm mb-2 mb-sm-0">
      <h1 class="page-header-title">Dashboard</h1>
    </div>

    <div class="col-sm-auto">
    </div>
  </div>
</div>
<!-- End Page Header -->

<!-- Stats -->
<div class="row gx-2 gx-lg-3">
  <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
    <!-- Card -->
    <a class="card card-hover-shadow h-100" href="<?= site_url('data-peserta') ?>">
      <div class="card-body">
        <h6 class="card-subtitle">Total Peserta</h6>

        <div class="row align-items-center gx-2 mb-1">
          <div class="col-8">
            <span class="card-title h2"><?= number_format($peserta,0,",",".");?> </span>
          </div>
        </div>
        <!-- End Row -->

        <span class="badge badge-soft-<?= ($diffPeserta == $peserta ? 'secondary' : ($diffPeserta < $peserta ? 'success' : 'danger'));?>">
          <i class="<?= ($diffPeserta == $peserta ? 'tio-voice-line' : ($diffPeserta < $peserta ? 'tio-trending-up' : 'tio-trending-down'));?>"></i>
          <?= ($peserta == 0 ? '0' : round(((($peserta-$diffPeserta) / $peserta) * 100), 1)) ?>%
        </span>
        <span class="text-body font-size-sm ml-1">dari <?= number_format($diffPeserta,0,",",".");?></span>
      </div>
    </a>
    <!-- End Card -->
  </div>
  <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
    <!-- Card -->
    <a class="card card-hover-shadow h-100" href="<?= site_url('k-panel/data-kegiatan') ?>">
      <div class="card-body">
        <h6 class="card-subtitle">Total Kegiatan</h6>

        <div class="row align-items-center gx-2 mb-1">
          <div class="col-8">
            <span class="card-title h2"><?= number_format($countKegiatan,0,",",".");?></span>
          </div>
        </div>
        <!-- End Row -->

        <span class="badge badge-soft-<?= ($diffKegiatan == $countKegiatan ? 'secondary' : ($diffKegiatan < $countKegiatan ? 'success' : 'danger'));?>">
          <i class="<?= ($diffKegiatan == $countKegiatan ? 'tio-voice-line' : ($diffKegiatan < $countKegiatan ? 'tio-trending-up' : 'tio-trending-down'));?>"></i>
          <?= ($countKegiatan == 0 ? '0' : round(((($countKegiatan-$diffKegiatan) / $countKegiatan) * 100), 1)) ?>%
        </span>
        <span class="text-body font-size-sm ml-1">dari <?= number_format($diffKegiatan,0,",",".");?></span>
      </div>
    </a>
    <!-- End Card -->
  </div>
</div>
<!-- End Stats -->



<div class="row">
  <div class="col-lg-4 mb-3 mb-lg-5">
    <!-- Card -->
    <div class="card h-100">
      <!-- Header -->
      <div class="card-header">
        <h4 class="card-header-title">Ratio kegiatan</h4>
      </div>
      <!-- End Header -->

      <!-- Body -->
      <div class="card-body text-center">

        <!-- Chart Half -->
        <div class="chartjs-doughnut-custom" style="height: 12rem;">
          <canvas class="js-chartjs-doughnut-half"
          data-hs-chartjs-options='{
            "type": "doughnut",
            "data": {
            "labels": ["Peserta", "Kegiatan"],
            "datasets": [{
            "data": [<?= $peserta;?>, <?= $countKegiatan;?>],
            "backgroundColor": ["#377dff", "rgba(55,125,255,.35)"],
            "borderWidth": 4,
            "hoverBorderColor": "#ffffff"
          }]
        }
      }'></canvas>

      <div class="chartjs-doughnut-custom-stat">
        <small class="text-cap">Total kegiatan</small>
        <span class="h1"><?= $countKegiatan;?></span>
      </div>
    </div>
    <!-- End Chart Half -->

    <hr>

    <div class="row">
      <div class="col text-right">
        <span class="d-block h4 text-primary mb-0">
          <i class="<?= ($diffPeserta == $peserta ? 'tio-voice-line' : ($diffPeserta < $peserta ? 'tio-trending-up' : 'tio-trending-down'));?>"></i><?= ($peserta == 0 ? '0' : round(((($peserta-$diffPeserta) / $peserta) * 100), 1)) ?>%
        </span>
        <span class="d-block">Peserta</span>
      </div>

      <div class="col column-divider text-left">
        <span class="d-block h4 text-success mb-0">
          <i class="<?= ($diffKegiatan == $countKegiatan ? 'tio-voice-line' : ($diffKegiatan < $countKegiatan ? 'tio-trending-up' : 'tio-trending-down'));?>"></i> <?= $newKegiatan;?>
        </span>
        <span class="d-block">Kegiatan terbaru</span>
      </div>
    </div>
    <!-- End Row -->
  </div>
  <!-- End Body -->
  </div>
  <!-- End Card -->
  </div>

  <div class="col-lg-8 mb-3 mb-lg-5">
    <!-- Card -->
    <div class="card h-100">
      <!-- Header -->
      <div class="card-header">
        <h4 class="card-header-title">Kegiatan terbaru</h4>
      </div>
      <!-- End Header -->

      <!-- Body -->
      <div class="card-body card-body-height">
        <ul class="list-group list-group-flush list-group-no-gutters">
          <?php if ($kegiatan != false) :?>
            <?php foreach ($kegiatan as $key) :?>
              <!-- List Item -->
              <li class="list-group-item">
                <div class="media">
                  <!-- Avatar -->
                  <div class="avatar avatar-sm avatar-soft-dark avatar-circle mr-3">
                    <span class="avatar-initials"><?= substr($key->JUDUL, 0, 1);?></span>
                  </div>
                  <!-- End Avatar -->

                  <div class="media-body">
                    <div class="row">
                      <div class="col-7 col-md-5 order-md-1">
                        <a href="<?= site_url('kegiatan/'.$key->KODE_KEGIATAN);?>"><h5 class="mb-0 text-muted"><?= $key->JUDUL;?></h5></a>
                      </div>

                      <div class="col-5 col-md-4 order-md-3 text-right mt-2 mt-md-0">
                        <h5 class="mb-0"><?= $CI->M_admin->count_pesertaKegiatan($key->KODE_KEGIATAN);?> peserta</h5>
                        <span class="font-size-sm"><?= date("d F Y", strtotime($key->TANGGAL));?></span>
                      </div>

                      <div class="col-auto col-md-3 order-md-2">
                        <span class="badge badge-soft-<?= $key->STATUS_KEGIATAN == 0 ? 'secondary' : ($key->STATUS_KEGIATAN == 1 ? 'success' : 'primary');?> badge-pill"><?= $key->STATUS_KEGIATAN == 0 ? 'belum dibuka' : ($key->STATUS_KEGIATAN == 1 ? 'berlangsung' : 'berakhir');?></span>
                      </div>
                    </div>
                    <!-- End Row -->
                  </div>
                </div>
              </li>
              <!-- End List Item -->
            <?php endforeach;?>
          <?php endif;?>
        </ul>
      </div>
      <!-- End Body -->
    </div>
    <!-- End Card -->
  </div>
</div>
<!-- End Row -->