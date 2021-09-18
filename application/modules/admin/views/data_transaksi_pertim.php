<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-sm mb-2 mb-sm-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter">
                    <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?= site_url('admin') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item">Kegiatan</li>
                    <li class="breadcrumb-item active" aria-current="page">Data kegiatan</li>
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
                    <th>Nama Tim</th>
                    <th>ID Transaksi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($transaksi as $row) {
                    if ($row->STAT_BAYAR == 1 || $row->STAT_BAYAR == 2) {
                        $status = '<span class="badge badge-warning">Belum Bayar</span>';
                    } elseif ($row->STAT_BAYAR == 3) {
                        $status = '<span class="badge badge-success">Sudah Bayar</span>';
                    } elseif ($row->STAT_BAYAR == 4) {
                        $status = '<span class="badge badge-danger">Pembayaran Gagal</span>';
                    } elseif ($row->STAT_BAYAR == 5) {
                        $status = '<span class="badge badge-primary">Refuded</span>';
                    } else {
                        $status = '<span class="badge badge-secondary">Belum Pilih Metode Bayar</span>';
                    }
                ?>
                    <tr>
                        <td scope="row"><?= $no ?></td>
                        <td><?= $row->NAMA_TIM ?></td>
                        <td><?= $row->KODE_TRANSAKSI ?></td>
                        <td><?= $status ?></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-xs">Details</button>
                        </td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
    </div>
</div>