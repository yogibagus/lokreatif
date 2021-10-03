<!-- Card -->
<?php if ($aktivasi->STATUS == 0) : ?>
  <div class="card card-frame card-frame-highlighted mb-4">
    <!-- Alert -->
    <div class="alert alert-soft-danger text-center rounded-0 mb-0" role="alert">
      Harap melakukan aktivasi akun terlebih dahulu untuk dapat mengelolah akun anda. <a class="alert-link" href="<?= site_url('hold-verification') ?>">AKTIVASI SEKARANG</a>
    </div>
    <!-- End Alert -->
  </div>
  <!-- End Card -->
<?php endif; ?>

<div class="row mb-4">
  <div class="col-12">
    <a href="<?= site_url(($daftarKompetisi > 0 ? 'peserta/data-pendaftaran' : 'daftar-kompetisi'));?>" class="card card-frame h-100">
      <div class="card-body">
        <!-- Icon Block -->
        <div class="media d-block d-sm-flex">
          <figure class="w-100 max-w-8rem mb-2 mb-sm-0 mr-sm-4">
            <img class="img-fluid" src="<?= base_url();?>assets/frontend/svg/icons/icon-7.svg" alt="SVG">
          </figure>
          <div class="media-body">
            <h2 class="h4 <?= $daftarKompetisi > 0 ? 'text-success' : 'text-warning';?>"><?= $daftarKompetisi > 0 ? 'Status Pendaftaran Lomba LO-Kreatif' : 'Status Pendaftaran Lomba LO-Kreatif';?></h2>
            <p class="font-size-1 text-body mb-0"><?= $daftarKompetisi > 0 ? 'Anda telah terdaftar dalam lomba LO-Kreatif' : 'Anda belum terdaftar dalam lomba LO-Kreatif. Daftar lomba sekarang';?> kompetisi <?= $WEB_JUDUL;?></p>
          </div>
        </div>
        <!-- End Icon Block -->
      </div>
    </a>
  </div>
</div>

<hr class="mb-4 mt-0">
<div class="row mb-4">
  <div class="col-md-7">
    <div class="card">
      <div class="card-header">
        <h5 class="card-header-title">Kegiatan terbaru</h5>
      </div>
      <!-- Table -->
      <div class="card-body px-0 pb-0">
        <table class="table table-borderless table-thead-bordered table-align-middle">
          <thead class="thead-light">
            <tr>
              <th>Kegiatan</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php if($kegiatan != false): ?>
              <?php foreach ($kegiatan as $key) :?>
                <tr>
                  <td>
                    <div class="media align-items-center">
                      <div class="avatar avatar-sm avatar-soft-dark avatar-circle mr-3">
                        <span class="avatar-initials"><?= substr($key->JUDUL, 0, 1);?></span>
                      </div>

                      <div class="media-body">
                        <a class="d-inline-block text-dark" href="<?= site_url('kegiatan/'.$key->KODE);?>">
                          <h6 class="text-hover-primary mb-0"><?= $key->JUDUL;?> <?= $CI->agent->is_mobile() ? '' : '<img class="avatar avatar-xss ml-1" src="'.base_url().'assets/frontend/svg/illustrations/top-vendor.svg" alt="Image Description" data-toggle="tooltip" data-placement="top" title="Verified">';?></h6>
                        </a>
                        <small class="d-block"><?= date("d F Y", strtotime($key->TANGGAL));?></small>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="badge badge-soft-<?= ($key->STATUS_KEGIATAN == 0 ? 'secondary' : ($key->STATUS_KEGIATAN == 1 ? 'success' : 'warning'));?> badge-pill"><?= ($key->STATUS_KEGIATAN == 0 ? 'belum dibuka' : ($key->STATUS_KEGIATAN == 1 ? 'berlangsung' : 'telah berakhir'));?></span>
                  </td>
                </tr>
              <?php endforeach;?>
            <?php endif;?>
          </tbody>
        </table>
      </div>
      <!-- End Table -->

      <!-- Footer -->
      <div class="card-footer d-flex justify-content-end">
      </div>
      <!-- End Footer -->
    </div>
  </div>
  <div class="col-md-5">
    <div class="card">
      <div class="card-header">
        <h5 class="card-header-title">Notifikasi terbaru</h5>
        <a href="<?= site_url('peserta/notifikasi') ?>" class="btn btn-primary btn-xs pull-right">more</a>
      </div>
      <!-- Table -->
      <div class="card-body scroll-y-400">
        <?php if ($notifikasi == false): ?>
          <div class="row">
            <div class="col-12">
              <div class="media align-items-center">
                <div class="media-body">
                  <a class="d-inline-block text-dark">
                    <h6 class="text-hover-primary mb-0"><center>Tidak ada notifikasi terbaru</center></h6>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <?php else: ?>
            <?php foreach ($notifikasi as $key): ?>
              <div class="row mb-4 cursor" data-target="#detail_notif<?= $key->ID_LOG?>" data-toggle="modal">
                <div class="col-12">
                  <div class="media align-items-center">
                    <div class="media-body">
                      <a class="d-inline-block text-dark">
                        <h6 class="text-hover-primary mb-0"><?= $key->REFERENCES ?></h6>
                      </a>
                      <small class="d-block text-muted"><span class="text-dark"><?= $CI->M_peserta->get_sender($key->SENDER) ?></span> <?= $key->MESSAGE ?></small>
                    </div>
                  </div>
                </div>
                <div class="col-12 text-right">
                  <small class="text-muted pull-right"><?= $CI->time_elapsed($key->CREATED_AT) ?></small>
                </div>
              </div>

              <!-- DELETE ACCOUNT -->

              <div id="detail_notif<?= $key->ID_LOG; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ubah_profil" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-body">
                      <!-- Form Group -->
                      <p class="h4"><b><?= $key->REFERENCES ?></b></p>
                      <p class="h6 text-muted"><span class="text-dark"><?= $CI->M_peserta->get_sender($key->SENDER) ?></span> <?= $key->MESSAGE ?><br> <small class="text-muted float-right pull-right mt-2"><?= $CI->time_elapsed($key->CREATED_AT) ?></small> </p>
                      <hr class="mt-5">
                      <button type="button" class="btn btn-xs btn-white btn-block" data-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END DELETE ACCOUNT -->
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
        <!-- End Table -->

        <!-- Footer -->
        <div class="card-footer d-flex justify-content-end">
        </div>
        <!-- End Footer -->
      </div>
    </div>
  </div>
