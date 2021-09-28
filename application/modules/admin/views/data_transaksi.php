<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-sm mb-2 mb-sm-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter">
                    <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?= site_url('admin') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item">Transaksi</li>
                    <li class="breadcrumb-item active" aria-current="page">Data Transaksi</li>
                </ol>
            </nav>
            <h1 class="page-header-title mt-3">Data Transaksi</h1>

            <!-- Stats -->
            <div class="row gx-2 gx-lg-3 mt-3">
                <div class="col-sm-12 col-lg-4 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="#">
                        <div class="card-body">
                            <h6 class="card-subtitle">Jumlah Transaksi</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-8">
                                    <span class="card-title h1"> <?= $jumlah_transaksi ?> </span>
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
                            <h6 class="card-subtitle">Total Uang Masuk</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-8">
                                    <span class="card-title h1">Rp <?= number_format($total_uang_masuk, 0, ',', '.') ?></span>
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
                            <h6 class="card-subtitle">Pembayaran Sukses</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-8">
                                    <span class="card-title h1"> <?= $jumlah_pembayaran_sukses ?></span>
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
    <div class="card-header">Data Transaksi</div>
    <div class="card-body">
        <table class="table table-stripped table-nowrap table-align-middle table-hover" width="100%" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Tgl. Transaksi</th>
                    <th>Dibayar Oleh</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($transaksi as $row) {

                    if ($row->ROLE_USER_BILL == 3) {
                        $user = $ci->General->get_univ_by_id($row->KODE_USER_BILL);
                    } elseif ($row->ROLE_USER_BILL == 1) {
                        $user = $ci->General->get_akun($row->KODE_USER_BILL);
                    }
                ?>
                    <tr>
                        <td scope="row"><?= $no ?></td>
                        <td><?= $row->KODE_TRANS ?></td>
                        <td><?= date("d M Y -H:i:s", strtotime($row->TGL_TRANSAKSI)) ?></td>
                        <td>
                            <?php
                            if ($row->ROLE_USER_BILL == 3) {
                                echo '<span class="legend-indicator bg-warning"></span>' . $user->namapt;
                            } elseif ($row->ROLE_USER_BILL == 1) {
                                echo '<span class="legend-indicator bg-primary"></span>' . $user->NAMA;
                            }
                            ?>
                        </td>
                        <td>
                            <?php if ($row->ORDER_ID != null) { ?>
                                <span class="badge badge-<?= $row->COLOR_STAT_PAY ?>"><?= $row->ALIAS_STAT_PAY ?></span>
                            <?php } else { ?>
                                <span class="badge badge-secondary">Belum pilih metode bayar</span>
                            <?php } ?>
                        </td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-xs" id="btn-details<?= $no ?>" data-toggle="modal" data-target="#detailsmodal<?= $no ?>">
                                Details
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="detailsmodal<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Detail Pembayaran</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-sm table-borderless col-8">
                                                <tbody>
                                                    <tr>
                                                        <td>Transaction ID</td>
                                                        <td>:</td>
                                                        <td><strong><?= $row->KODE_TRANS ?></strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Order ID</td>
                                                        <td>:</td>
                                                        <td><strong><?= ($row->ORDER_ID != null) ? $row->ORDER_ID : '<span class="badge badge-danger">Belum memilih metode pembayaran</span>' ?></strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Payment ID</td>
                                                        <td>:</td>
                                                        <td><strong><?= ($row->PAYMENT_ID != null) ? $row->PAYMENT_ID : '-' ?></strong></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Dibayar Oleh</td>
                                                        <td>:</td>
                                                        <td><strong><?php
                                                                    if ($row->ROLE_USER_BILL == 3) {
                                                                        echo $user->namapt;
                                                                    } elseif (
                                                                        $row->ROLE_USER_BILL == 1
                                                                    ) {
                                                                        echo $user->NAMA;
                                                                    }
                                                                    ?>
                                                            </strong>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>Metode Pembayaran</td>
                                                        <td>:</td>
                                                        <td><strong><?= ($row->NAMA_PAY_METHOD != null) ? $row->NAMA_PAY_METHOD : '-' ?></strong></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Update Terakhir</td>
                                                        <td>:</td>
                                                        <td><strong><?= ($row->LOG_TIME != null) ? $row->LOG_TIME : '-' ?></strong></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Status Pembayaran</td>
                                                        <td>:</td>
                                                        <td><strong class="<?= ($row->COLOR_STATUS_PAYMENT != null) ? "text-" . $row->COLOR_STATUS_PAYMENT : "-" ?>"><?= ($row->ALIAS_STATUS_PAYMENT != null) ? $row->ALIAS_STATUS_PAYMENT : "-" ?></strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="detail"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edittrans<?= $no ?>">
                                <i class="tio-settings"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="edittrans<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Ubah Status Transaksi - #<?= $row->KODE_TRANS ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="<?= base_url('admin/update_status_transaksi/' . $row->KODE_TRANS) ?>" method="POST">
                                            <div class="modal-body">
                                                <div class="alert alert-soft-warning text-dark" role="alert">
                                                    <strong><i class="tio-info"></i></strong> Hati-hati dalam mengubah status transaksi.
                                                </div>
                                                <label for="">Status Saat Ini:</label><br>
                                                <span class="badge badge-<?= $row->COLOR_STAT_PAY ?>"><?= $row->ALIAS_STAT_PAY ?></span>
                                                <div class="form-group mt-3">
                                                    <label for="">Ubah Status Transaksi:</label>
                                                    <select class="form-control" name="status_transaksi" id="">
                                                        <?php foreach ($stat_pay as $s) { ?>
                                                            <option value="<?= $s->ID_STAT_PAY ?>" <?= ($s->ID_STAT_PAY == $row->ID_STAT_PAY) ? "selected" : "" ?>><?= $s->ID_STAT_PAY . " - " . $s->NAMA_STAT_PAY . " - " . $s->ALIAS_STAT_PAY ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deletetrans<?= $no ?>">
                                <i class="tio-delete"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="deletetrans<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus Transaksi #<?= $row->KODE_TRANS ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <span class="">
                                                <p>
                                                    Apakah Anda yakin untuk <strong class="text-danger">menghapus</strong><br> Transaksi <strong>#<?= $row->KODE_TRANS ?></strong> secara <strong>permanen</strong>?
                                                </p>
                                            </span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('admin/delete_transaksi/' . $row->KODE_TRANS) ?>" class="btn btn-danger">Ya, Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <script>
                        $("#btn-details<?= $no ?>").click(function() {
                            $(".detail").html(`<center><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sedang memuat tim...</center>`);
                            jQuery.ajax({
                                url: "<?= base_url('admin/get_details_tim_payment/' . $row->KODE_TRANS) ?>",
                                type: "GET",
                                success: function(data) {
                                    $(".detail").html(data);
                                }
                            });
                        });
                    </script>
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