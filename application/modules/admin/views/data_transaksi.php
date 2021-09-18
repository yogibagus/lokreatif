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

            <h1 class="page-header-title">Data kegiatan</h1>
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
        <table class="table table-stripped table-nowrap table-align-middle table-hover" width="100%" id="datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Nominal</th>
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
                        <td>Rp <?= number_format($row->TOT_BAYAR, 0, ',', '.') ?></td>
                        <td>
                            <?php
                            if ($row->ROLE_USER_BILL == 3) {
                                echo '<span class="legend-indicator bg-warning"></span>' . $user->namapt;
                            } elseif ($row->ROLE_USER_BILL == 1) {
                                echo '<span class="legend-indicator bg-primary"></span>' . $user->NAMA;
                            }
                            ?>
                        </td>
                        <td><span class="badge badge-<?= $row->COLOR_STAT_PAY ?>"><?= $row->ALIAS_STAT_PAY ?></span></td>
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
                                                        <td>ID Transaksi</td>
                                                        <td>:</td>
                                                        <td><strong><?= $row->KODE_TRANS ?></strong></td>
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
                                                        <td><strong><?= $row->NAMA_PAY_METHOD ?></strong></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Update Terakhir</td>
                                                        <td>:</td>
                                                        <td><strong><?= $row->LOG_TIME ?></strong></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Status Pembayaran</td>
                                                        <td>:</td>
                                                        <td><strong class="text-<?= $row->COLOR_STAT_PAY ?>"><?= $row->ALIAS_STAT_PAY ?></strong></td>
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