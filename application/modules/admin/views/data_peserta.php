<!-- Page Header -->
<div class="page-header">
  <div class="row align-items-end">
    <div class="col-sm mb-2 mb-sm-0">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-no-gutter">
          <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?= site_url('admin') ?>">dashboard</a></li>
          <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Peserta</a></li>
          <li class="breadcrumb-item active" aria-current="page">Data Peserta</li>
        </ol>
      </nav>

      <h1 class="page-header-title">Data Peserta</h1>
    </div>

    <div class="col-sm-auto">
    </div>
  </div>
  <!-- End Row -->
</div>
<!-- End Page Header -->

<!-- Stats -->
<div class="row gx-2 gx-lg-3">
  <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
    <!-- Card -->
    <div class="card h-100">
      <div class="card-body">
        <h6 class="card-subtitle mb-2">Total peserta</h6>

        <div class="row align-items-center gx-2">
          <div class="col">
            <span class="js-counter display-4 text-dark"><?= number_format($countPeserta,0,",",".");?></span>
          </div>
        </div>
        <!-- End Row -->
      </div>
    </div>
    <!-- End Card -->
  </div>

  <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
    <!-- Card -->
    <div class="card h-100">
      <div class="card-body">
        <h6 class="card-subtitle mb-2">Peserta baru</h6>

        <div class="row align-items-center gx-2">
          <div class="col">
            <span class="js-counter display-4 text-dark"><?= number_format($NewPeserta,0,",",".");?></span>
          </div>

          <div class="col-auto">
            <span class="badge badge-soft-<?= ($NewPeserta == 0 ? 'secondary' : ($NewPeserta > $countPeserta ? 'success' : 'danger'));?> p-1">
              <i class="<?= ($NewPeserta == 0 ? 'tio-voice-line' : ($NewPeserta > $countPeserta ? 'tio-trending-up' : 'tio-trending-down'));?>"></i>
              <?= ($NewPeserta == 0 ? '0' : round(((($countPeserta-$NewPeserta) / $countPeserta) * 100), 1)) ?>%
            </span>
          </div>
        </div>
        <!-- End Row -->
      </div>
    </div>
    <!-- End Card -->
  </div>

  <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
    <!-- Card -->
    <div class="card h-100">
      <div class="card-body">
        <h6 class="card-subtitle mb-2">Peserta non-aktif</h6>

        <div class="row align-items-center gx-2">
          <div class="col">
            <span class="js-counter display-4 text-dark"><?= number_format($nonPeserta,0,",",".");?></span>
          </div>

          <div class="col-auto">
            <span class="badge badge-soft-<?= ($diffNonPeserta == $nonPeserta ? 'secondary' : ($diffNonPeserta < $nonPeserta ? 'success' : 'danger'));?> p-1">
              <i class="<?= ($diffNonPeserta == $nonPeserta ? 'tio-voice-line' : ($diffNonPeserta < $nonPeserta ? 'tio-trending-up' : 'tio-trending-down'));?>"></i>
              <?= ($nonPeserta == 0 ? '0' : round(((($nonPeserta-$diffNonPeserta) / $nonPeserta) * 100), 1)) ?>%
            </span>
          </div>
        </div>
        <!-- End Row -->
      </div>
    </div>
    <!-- End Card -->
  </div>
</div>
<!-- End Stats -->

<!-- Card -->
<div class="card">
  <!-- Table -->
  <div class="card-body">
    <div class="table-responsive">
      <table id="myTable" class="table table-stripped table-nowrap table-align-middle table-hover" width="100%">
        <thead class="thead-light">
          <tr>
            <th class="table-column-pr-0">No</th>
            <th class="table-column-pl-0">Nama</th>
            <th>Jenis Kelamin</th>
            <th>Telepon</th>
            <!-- <th>Instansi/Role</th> -->
            <th></th>
          </tr>
        </thead>

        <tbody>
          <?php if ($countPeserta > 0): ?>
            <?php $no = 1; foreach ($peserta as $key): ?>
            <tr>
              <td class="table-column-pr-0"><?= $no++; ?></td>
              <td class="table-column-pl-0">
                <a class="d-flex align-items-center" href="mailto:<?= $key->EMAIL ?>">
                  <div class="avatar avatar-circle">
                    <img class="avatar-img" src="<?= ($key->PROFIL == null ? base_url().'assets/frontend/img/100x100/img12.jpg' : base_url().'berkas/peserta/'.$key->KODE_USER.'/foto/'.$key->PROFIL);?>" alt="Image Description">
                  </div>
                  <div class="ml-3">
                    <span class="d-block h5 text-hover-primary mb-0"><?= $key->NAMA ?></span>
                    <span class="d-block font-size-sm text-body"><?= $key->EMAIL ?></span>
                  </div>
                </a>
              </td>
              <td><?= ($key->JK == "L" ? "Laki-laki" : "Perempuan") ?></td>
              <td><a href="tel:+62<?= $key->HP ?>">+62<?= $key->HP ?></a></td>
              <td>
                <a class="btn btn-sm btn-white" data-toggle="modal" data-target="#detailUser<?= $key->KODE_USER;?>">
                  <i class="tio-eye"></i> View
                </a>
              </td>
            </tr>
            <!-- detail user Modal -->
            <div class="modal fade" id="detailUser<?= $key->KODE_USER;?>" tabindex="-1" role="dialog" aria-labelledby="detailUserModalTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <!-- Header -->
                  <div class="modal-header">
                    <h4 id="detailUserModalTitle" class="modal-title">Detail peserta</h4>

                    <button type="button" class="btn btn-white mr-2" data-dismiss="modal" aria-label="Close">Tutup</button>
                  </div>
                  <!-- End Header -->

                  <!-- Body -->
                  <div class="modal-body">
                    <!-- Profile Cover -->
                    <div class="profile-cover">
                      <div class="profile-cover-img-wrapper">
                        <img id="detailProfileCoverImgModal" class="profile-cover-img" src="<?= base_url() ?>assets/backend/img/1920x400/img1.jpg" alt="<?= $key->NAMA ?>">
                      </div>
                    </div>
                    <!-- End Profile Cover -->

                    <!-- Avatar -->
                    <label class="avatar avatar-xxl avatar-circle avatar-border-lg profile-cover-avatar mb-5" for="detailAvatarUploaderModal">
                      <img id="detailAvatarImgModal" class="avatar-img" src="<?= ($key->PROFIL == null ? base_url().'assets/frontend/img/100x100/img12.jpg' : base_url().'berkas/peserta/'.$key->KODE_USER.'/foto/'.$key->PROFIL);?>" alt="<?= $key->NAMA ?>">
                    </label>
                    <!-- End Avatar -->

                    <!-- Form Group -->
                    <div class="row form-group">
                      <label for="detailFirstNameModalLabel" class="col-sm-3 col-form-label input-label">Nama Lengkap</label>

                      <div class="col-sm-9">
                        <div class="js-form-message input-group input-group-sm-down-break">
                          <input type="text" class="form-control" name="detailFirstNameModal" id="detailFirstNameModalLabel" value="<?= $key->NAMA;?>" readonly>
                        </div>
                      </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="row form-group">
                      <label for="detailEmailModalLabel" class="col-sm-3 col-form-label input-label">Email</label>

                      <div class="col-sm-9">
                        <div class="js-form-message">
                          <!-- Input Group -->
                          <div class="input-group input-group-merge">
                            <input type="email" class="form-control" name="detailEmailModal" id="detailEmailModalLabel" value="<?= $key->EMAIL;?>" readonly>
                            <a class="input-group-append" href="mailto:<?= $key->EMAIL;?>" target="_blank">
                              <span class="input-group-text p-2">
                                send mail
                              </span>
                            </a>
                          </div>
                          <!-- End Input Group -->
                        </div>
                      </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="row form-group">
                      <label for="detailEmailModalLabel" class="col-sm-3 col-form-label input-label">Telepon</label>

                      <div class="col-sm-4">
                        <div class="js-form-message">
                        </div>
                        <!-- Input Group -->
                        <div class="input-group input-group-merge">
                          <input type="text" class="form-control" name="detailEmailModal" id="detailEmailModalLabel" value="+62<?= $key->HP;?>" readonly>
                          <span class="input-group-append">
                            <a href="https://api.whatsapp.com/send?text=Hai&phone=+62<?= $key->HP;?>" target="_blank">
                              <span class="input-group-text" style="padding-top: .75rem !important">
                                <i class="tio-whatsapp"></i>
                              </span>
                            </a>
                            <a href="tel:+62<?= $key->HP;?>" target="_blank">
                              <span class="input-group-text" style="padding-top: .75rem !important">
                                <i class="tio-call-talking"></i>
                              </span>
                            </a>
                          </span>
                        </div>
                        <!-- End Input Group -->
                      </div>
                      <label for="detailEmailModalLabel" class="col-sm-3 col-form-label input-label">Jenis Kelamin</label>

                      <div class="col-sm-2">
                        <div class="js-form-message">
                          <input type="text" class="form-control" name="detailEmailModal" id="detailEmailModalLabel" value="<?= $key->JK;?>" readonly>
                        </div>
                      </div>
                    </div>
                    <!-- End Form Group -->
                    <hr>
                    <?php if ($CI->M_admin->get_pesertaPendaftaran($key->KODE_USER) == false) :?>
                      <div class="alert alert-info">
                        <p class="mb-0 text-center">Belum mendaftarkan diri dalam kompetisi LO Kreatif 2021</p>
                      </div>
                    <?php else:?>

                    <!-- Form Group -->
                    <div class="row form-group">
                      <label for="detailFirstNameModalLabel" class="col-sm-3 col-form-label input-label">Bidang Lomba</label>

                      <div class="col-sm-9">
                        <div class="js-form-message input-group input-group-sm-down-break">
                          <input type="text" class="form-control" name="detailFirstNameModal" id="detailFirstNameModalLabel" value="<?= $CI->M_admin->get_pesertaPendaftaran($key->KODE_USER)->LOMBA;?>" readonly>
                        </div>
                      </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="row form-group">
                      <label for="detailFirstNameModalLabel" class="col-sm-3 col-form-label input-label">Asal PTS</label>

                      <div class="col-sm-9">
                        <div class="js-form-message input-group input-group-sm-down-break">
                          <input type="text" class="form-control" name="detailFirstNameModal" id="detailFirstNameModalLabel" value="<?= $CI->M_admin->get_pesertaPendaftaran($key->KODE_USER)->namapt;?>" readonly>
                        </div>
                      </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="row form-group">
                      <label for="detailFirstNameModalLabel" class="col-sm-3 col-form-label input-label">Nama TIM</label>

                      <div class="col-sm-9">
                        <div class="js-form-message input-group input-group-sm-down-break">
                          <input type="text" class="form-control" name="detailFirstNameModal" id="detailFirstNameModalLabel" value="<?= $CI->M_admin->get_pesertaPendaftaran($key->KODE_USER)->NAMA_TIM;?>" readonly>
                        </div>
                      </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="row form-group">
                      <label for="detailFirstNameModalLabel" class="col-sm-3 col-form-label input-label">Status TIM</label>

                      <div class="col-sm-9">
                        <?php switch ($CI->M_admin->get_pesertaPendaftaran($key->KODE_USER)->STATUS) {
                          case 0:
                            echo '<span class="btn btn-sm btn-secondary">Menunggu proses verifikasi</span>';
                            break;

                          case 1:
                            echo '<span class="btn btn-sm btn-success">Berkas telah diverifikasi</span>';
                            break;

                          case 2:
                            echo '<span class="btn btn-sm btn-danger">Berkas ditolak</span>';
                            break;

                          case 3:
                            echo '<span class="btn btn-sm btn-warning">Masuk ke babak Final</span>';
                            break;
                          
                          default:
                            echo '<span class="btn btn-sm btn-secondary">Menunggu proses verifikasi</span>';
                            break;
                        };?>
                      </div>
                    </div>
                    <!-- End Form Group -->
                    <?php endif;?>
                  </div>
                  <!-- End Form Group -->
                </div>
                <!-- End Body -->
              </div>
            </div>
            <!-- End detail user Modal -->
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<!-- End Table -->
</div>
<!-- End Card -->
