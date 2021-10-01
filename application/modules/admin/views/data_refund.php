<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-sm mb-2 mb-sm-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter">
                    <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?= site_url('admin') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item">Pembayaran</li>
                    <li class="breadcrumb-item active" aria-current="page">Data Refund</li>
                </ol>
            </nav>
            <h1 class="page-header-title mt-3">Data Refund</h1>

            <!-- Stats -->
            <div class="row gx-2 gx-lg-3 mt-3">
                <div class="col-sm-12 col-lg-4 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="#">
                        <div class="card-body">
                            <h6 class="card-subtitle">Jumlah Refund</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-8">
                                    <span class="card-title h1"> <?= $countRefund ?></span>
                                </div>
                            </div>
                            <!-- End Row -->
                        </div>
                    </a>
                    <!-- End Card -->
                </div>
                <div class="col-sm-12 col-lg-4 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="#">
                        <div class="card-body">
                            <h6 class="card-subtitle">Refund Sukses</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-8">
                                    <span class="card-title h1"> <?= $countSudahRefund ?></span>
                                </div>
                            </div>
                            <!-- End Row -->
                        </div>
                    </a>
                    <!-- End Card -->
                </div>
                <div class="col-sm-12 col-lg-4 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="#">
                        <div class="card-body">
                            <h6 class="card-subtitle">Refund Dibayarkan</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-8">
                                    <span class="card-title h1">Rp <?= number_format($sumTotalRefundSukses, 0, ',', '.') ?></span>
                                </div>
                            </div>
                            <!-- End Row -->
                        </div>
                    </a>
                    <!-- End Card -->
                </div>
            </div>
            <!-- End Stats -->
        </div>

        <div class="col-sm-auto">
        </div>
    </div>
    <!-- End Row -->
</div>
<!-- End Page Header -->

<div class="card">
    <div class="card-header">Data Refund</div>
    <div class="card-body">
        <table class="table table-stripped table-nowrap table-align-middle table-hover" width="100%" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Aksi</th>
                    <th>Tgl. Update</th>
                    <th>Penerima Refund</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($refund as $row) {
                    if ($row->ROLE_USER_BILL == 3) {
                        $user = $ci->General->get_univ_by_id($row->KODE_USER_BILL);
                    } elseif ($row->ROLE_USER_BILL == 1) {
                        $user = $ci->General->get_akun($row->KODE_USER_BILL);
                    }
                ?>
                    <tr>
                        <th><?= $no ?></th>
                        <th>
                            <?php if ($row->STAT_REFUND == 0) { ?>
                                <button class="btn btn-success btn-xs" href="#" role="button" disabled>
                                    <i class="tio-cached"></i>
                                </button>
                            <?php } elseif ($row->STAT_REFUND == 1) { ?>
                                <button class="btn btn-success btn-xs" title="Refund Sukses" data-toggle="modal" data-target="#terimarefund<?= $no ?>">
                                    <i class="tio-done"></i>
                                </button>
                                <button class="btn btn-danger btn-xs" title="Refund Ditolak" data-toggle="modal" data-target="#tolakrefund<?= $no ?>">
                                    <i class="tio-clear"></i>
                                </button>
                            <?php } elseif ($row->STAT_REFUND == 2) { ?>
                                <button class="btn btn-danger btn-xs" title="Refund Ditolak" data-toggle="modal" data-target="#tolakrefund<?= $no ?>">
                                    <i class="tio-clear"></i>
                                </button>
                                <button class="btn btn-secondary btn-xs" title="Reset Status Refund" data-toggle="modal" data-target="#resetrefund<?= $no ?>">
                                    <i class="tio-cached"></i>
                                </button>
                            <?php } elseif ($row->STAT_REFUND == 3) { ?>
                                <button class="btn btn-success btn-xs" title="Refund Sukses" data-toggle="modal" data-target="#terimarefund<?= $no ?>">
                                    <i class="tio-done"></i>
                                </button>
                                <button class="btn btn-secondary btn-xs" title="Reset Status Refund" data-toggle="modal" data-target="#resetrefund<?= $no ?>">
                                    <i class="tio-cached"></i>
                                </button>
                            <?php } ?>


                            <!-- Modal Terima -->
                            <div class="modal fade" id="terimarefund<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Refund Sukses - <?= $row->KODE_REFUND ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-soft-warning text-dark" role="alert">
                                                <strong>Perhatian!</strong> Pastikan Anda telah mengirim dana refund ke rekening <br>penerima sesuai jumlah refund yang tertera pada details.
                                            </div>
                                            <span>Apakah Anda yakin mengubah status Refund <strong>#<?= $row->KODE_REFUND ?></strong> ?</span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('admin/update_refund/' . $row->KODE_REFUND . "/" . 2) ?>" type="button" class="btn btn-success">Ya, Refund Sukses</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Tolak -->
                            <div class="modal fade" id="tolakrefund<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tolak Refund - <?= $row->KODE_REFUND ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <span>Apakah Anda yakin mengubah status Refund <strong>#<?= $row->KODE_REFUND ?></strong> ?</span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('admin/update_refund/' . $row->KODE_REFUND . "/" . 3) ?>" class="btn btn-danger">Ya, Tolak Refund</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Tolak -->
                            <div class="modal fade" id="resetrefund<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Reset Status Refund - <?= $row->KODE_REFUND ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <span>Apakah Anda yakin mengatur ulang status Refund <strong>#<?= $row->KODE_REFUND ?></strong> ?</span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('admin/update_refund/' . $row->KODE_REFUND . "/" . 1) ?>" class="btn btn-secondary">Ya, Reset Status Refund</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </th>
                        <th>
                            <?= date("d M Y - H:i:s", strtotime($row->LOG_TIME)) ?>
                        </th>
                        <th>
                            <?php
                            if ($row->ROLE_USER_BILL == 3) {
                                echo '<span class="legend-indicator bg-warning"></span>' . $user->namapt;
                                $nama = $user->namapt;
                            } elseif ($row->ROLE_USER_BILL == 1) {
                                echo '<span class="legend-indicator bg-primary"></span>' . $user->NAMA;
                                $nama = $user->NAMA;
                            }
                            ?>
                        </th>
                        <th>
                            Rp <?= number_format($row->JML_REFUND, 0, ',', '.') ?>
                        </th>
                        <th>
                            <?php if ($row->STAT_REFUND == 0) { ?>
                                <span class="badge badge-secondary">User Belum Request</span>
                            <?php } elseif ($row->STAT_REFUND == 1) { ?>
                                <span class="badge badge-warning">Menunggu Untuk Diproses</span>
                            <?php } elseif ($row->STAT_REFUND == 2) { ?>
                                <span class="badge badge-success">Refund Sukses</span>
                            <?php } elseif ($row->STAT_REFUND == 4) { ?>
                                <span class="badge badge-success">Ditolak</span>
                            <?php } ?>
                        </th>
                        <th>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modaldetail<?= $no ?>">
                                <i class="tio-invisible"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modaldetail<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Refund - <?= $row->KODE_REFUND ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-soft-info" role="alert">
                                                <strong>Perhatian! </strong>Gunakan informasi dibawah untuk melakukan refund<br>kepada pengguna.
                                            </div>
                                            <table class="w-100">
                                                <tr>
                                                    <td>Refund ID</td>
                                                    <td>:</td>
                                                    <td><strong><?= $row->KODE_REFUND ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Transaksi ID</td>
                                                    <td>:</td>
                                                    <td><strong><?= $row->KODE_TRANS ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Update Terakhir</td>
                                                    <td>:</td>
                                                    <td><strong><?= $row->LOG_TIME ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Penerima Refund</td>
                                                    <td>:</td>
                                                    <td><strong><?= $nama ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Metode Pembayaran
                                                        <i class="tio-help-outlined" data-toggle="tooltip" data-placement="top" title="Metode pembayaran penerima refund">
                                                        </i>
                                                    </td>
                                                    <td>:</td>
                                                    <td><strong><?= ($row->METHOD != null) ? $row->METHOD : '-' ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Pembayaran Melalui
                                                        <i class="tio-help-outlined" data-toggle="tooltip" data-placement="top" title="Tipe Bank penerima refund">
                                                        </i>
                                                    </td>
                                                    <td>:</td>
                                                    <td><strong><?= ($row->VIA != null) ? $row->VIA : '-' ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Nomor Rekening
                                                        <i class="tio-help-outlined" data-toggle="tooltip" data-placement="top" title="Nomor Rekening penerima refund">
                                                        </i>
                                                    </td>
                                                    <td>:</td>
                                                    <td><strong><?= ($row->NO_VIA != null) ? $row->NO_VIA : '-' ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Atas Nama
                                                        <i class="tio-help-outlined" data-toggle="tooltip" data-placement="top" title="Atas Nama penerima refund">
                                                        </i>
                                                    </td>
                                                    <td>:</td>
                                                    <td><strong><?= ($row->AN_VIA != null) ? $row->AN_VIA : '-' ?></strong></td>
                                                </tr>
                                            </table>
                                            <?php if ($row->BUKTI_REFUND != null) { ?>
                                                <hr>
                                                <label for="">Bukti Refund:</label><br>
                                                <img src="<?= base_url('berkas/refund/' . $row->BUKTI_REFUND) ?>" class="img-fluid img-thumbnail" alt="Bukti Refund">
                                            <?php } ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </th>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-auto">
                <span class="legend-indicator bg-warning"></span>PTS
            </div>
            <div class="col-auto">
                <span class="legend-indicator bg-primary"></span>Ketua Tim
            </div>
        </div>
    </div>
</div>