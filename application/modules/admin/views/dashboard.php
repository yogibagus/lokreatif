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