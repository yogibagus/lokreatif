<!-- Page Header -->
<div class="page-header">
  <div class="row align-items-end">
    <div class="col-sm mb-2 mb-sm-0">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-no-gutter">
          <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?= site_url('manage-kompetisi') ?>">Dashboard</a></li>
          <li class="breadcrumb-item">Pendaftaran</li>
          <li class="breadcrumb-item active" aria-current="page">Verifikasi berkas</li>
        </ol>
      </nav>

      <h1 class="page-header-title">Verifikasi Berkas</h1>
    </div>

    <div class="col-sm-auto">
    </div>
  </div>
  <!-- End Row -->
</div>
<!-- End Page Header -->

<!-- Card -->
<?php if ($cek_form == false):?>
  <div class="alert alert-info shadow">
    <p class="mb-0"><b>PERINGATAN!!</b>Anda belum mengatur formulir pendaftaran!!, harap atur terlebih dahulu agar peserta dapat mulai mendaftarkan diri pada event anda.</p>
  </div>
  <?php else:?>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="myTable" class="table table-stripped table-nowrap table-align-middle table-hover" width="100%">
            <thead class="thead-light">
              <tr>
                <th>No</th>
                <th></th>
                <th>Status</th>
                <th>NAMA TIM</th>
                <th>KETUA</th>
                <?php foreach ($get_form as $key) :?>
                  <th><?= $key->PERTANYAAN;?></th>
                <?php endforeach;?>
              </tr>
            </thead>
            <tbody>
              <?php if ($get_pendaftaran == false) :?>
                <td colspan="<?= 3+count($get_form);?>"><center>belum ada data pendaftaran</center></td>
                <?php else:?>
                  <?php $no = 1; foreach ($get_pendaftaran as $data) :?>
                  <tr>
                    <td><?= $no++;?></td>
                    <td>
                      <?php if ($data->STATUS == 0) :?>
                        <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#verif<?= $no;?>">verif</button>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#tolak<?= $no;?>">tolak</button>
                        <?php elseif($data->STATUS == 1):?>
                          <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#tolak<?= $no;?>">tolak</button>
                          <?php elseif($data->STATUS == 2):?>
                            <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#verif<?= $no;?>">verif</button>
                          <?php endif;?>
                        </td>
                        <td>
                          <?php switch ($data->STATUS) {
                            case 0:
                            echo '<span class="badge badge-secondary">Menunggu proses verifikasi</span>';
                            break;

                            case 1:
                            echo '<span class="badge badge-success">Berkas telah diverifikasi</span>';
                            break;

                            case 2:
                            echo '<span class="badge badge-danger">Berkas ditolak</span>';
                            break;

                            case 3:
                            echo '<span class="badge badge-warning">Masuk ke babak Final</span>';
                            break;

                            default:
                            echo '<span class="badge badge-secondary">Menunggu proses verifikasi</span>';
                            break;
                          };?>

                        </td>
                        <td><?= $data->NAMA_TIM;?></td>
                        <td><?= $data->NAMA;?></td>
                        <?php foreach ($get_form as $key) :?>
                          <td>
                            <?php if ($CI->M_manage->get_formData($data->KODE_PENDAFTARAN, $key->ID_FORM) == false) :?>
                              <button type="button" class="btn btn-xs btn-secondary" >belum melengkapi</button>
                              <?php else:?>
                                <a href="<?= base_url();?>berkas/pendaftaran/kompetisi/lokreatif/<?= $data->KODE_USER;?>/<?= $CI->M_manage->get_formData($data->KODE_PENDAFTARAN, $key->ID_FORM);?>" class="btn btn-xs btn-warning" target="_blank">cek berkas</a>
                              <?php endif;?>
                            </td>
                          <?php endforeach;?>
                        </tr>
                        <div class="modal fade" id="verif<?= $no;?>" tabindex="-1" role="dialog" aria-labelledby="detailUserModalTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                              <!-- Header -->
                              <div class="modal-header">
                                <h4 id="detailUserModalTitle" class="modal-title">Verifikasi berkas peserta</h4>
                              </div>
                              <!-- End Header -->

                              <!-- Body -->
                              <div class="modal-body">
                                <p class="mb-0">Verifikasi berkas peserta, <b><?= $data->NAMA_TIM;?></b></p>
                              </div>

                              <!-- Body -->
                              <div class="modal-footer">
                                <form action="<?= site_url('manage_kompetisi/terima_pendaftaran');?>" method="post">
                                  <input type="hidden" name="KODE_USER" value="<?= $data->KODE_USER;?>">
                                  <input type="hidden" name="NAMA_TIM" value="<?= $data->NAMA_TIM;?>">
                                  <button type="button" class="btn btn-sm btn-light" data-dismiss="modal" aria-label="Close">Batal</button>
                                  <button type="submit" class="btn btn-sm btn-success">Verifikasi</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal fade" id="tolak<?= $no;?>" tabindex="-1" role="dialog" aria-labelledby="detailUserModalTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                              <!-- Header -->
                              <div class="modal-header">
                                <h4 id="detailUserModalTitle" class="modal-title">Tolak berkas peserta</h4>
                              </div>
                              <!-- End Header -->

                              <!-- Body -->
                              <div class="modal-body">
                                <p class="mb-0">Tolak berkas peserta, <b><?= $data->NAMA_TIM;?></b></p>
                                <hr class="my-1">
                                <p class="mb-0">Hubungi ketua tim, untuk konfirmasi berkas sebelum menolak pendaftaran ini?
                                  <a href="https://api.whatsapp.com/send?text=Hai&phone=+62<?= $data->HP;?>" target="_blank" class="text-success"><i class="tio-whatsapp"></i> hubungi sekarang</a></p>
                                </div>

                                <!-- Body -->
                                <div class="modal-footer">
                                  <form action="<?= site_url('manage_kompetisi/tolak_pendaftaran');?>" method="post">
                                    <input type="hidden" name="KODE_USER" value="<?= $data->KODE_USER;?>">
                                    <input type="hidden" name="NAMA_TIM" value="<?= $data->NAMA_TIM;?>">
                                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal" aria-label="Close">Batal</button>
                                    <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php endforeach;?>
                      <?php endif;?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          <?php endif;?>
<!-- End Card -->