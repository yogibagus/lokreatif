<style>
    .fit-image {
        width: 130px;
        object-fit: cover;
        height: 60px;
        /* only if you want fixed height */
    }
</style>
<div class="container space-3" id="printableArea">
    <div class="d-flex justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class=" card-header">
                    <h4>INVOICE</h4>
                    <button type="button" class="btn btn-xs btn-primary" onclick="printDiv('printableArea')"><i class="fa fa-print" aria-hidden="true"></i> Cetak Invoice</button>
                </div>
                <div class="card-body">
                    <center>
                        <img src="<?= base_url('assets/logo-ts.png') ?>" style="max-width: 300px;" class="img-fluid mb-1" alt="">
                        <p class="col-11">
                            Kompetisi Nasional Mahasiswa Perguruan Tinggi Swasta seluruh Indonesia <br> Diselenggarakan oleh APTISI 7 JATIM<br>
                            Jl. Arief Rahman Hakim 103, Surabaya - Jawa Timur
                        </p>
                    </center>
                    <hr>
                    <div class="row text-center">
                        <div class="col-5">
                            <span>Kepada Yth:</Span><br>
                            <span><strong><?= $nama ?></strong></span><br>
                            <span><?= $user->EMAIL ?></span><br>
                            <span>+62<?= $user->HP ?></span><br>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-5">
                            <span>Nomor Invoice:</span> <br>
                            <span><strong>ID #<?= $kode_trans ?></strong></span><br>
                            <span>Tanggal:</span><br>
                            <?php
                            $time = strtotime($payment->LOG_TIME);
                            $paid_on = date('d M Y H:i:s', $time);
                            ?>
                            <span><strong><?= $paid_on; ?></strong></span><br>
                        </div>
                    </div>
                    <hr>
                    <center>
                        <span class="mt-3 col-10">Berikut rincian pembayaran Anda:</span>
                    </center>
                    <div class="">
                        <table class="table table-sm table-borderless col-8">
                            <tbody>
                                <tr>
                                    <td>Metode Pembayaran</td>
                                    <td>:</td>
                                    <td><strong><?= $payment->NAMA_PAY_METHOD ?></strong></td>
                                </tr>
                                <br>
                                <tr>
                                    <td>Waktu Pembayaran</td>
                                    <td>:</td>
                                    <td><strong><?= $paid_on ?></strong></td>
                                </tr>
                                <br>
                                <tr>
                                    <td>Status Pembayaran</td>
                                    <td>:</td>
                                    <td><strong class="text-<?= $payment->COLOR_STAT_PAY ?>"><?= $payment->ALIAS_STAT_PAY ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table mt-3">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nama Tim</th>
                                    <th>Bidang Lomba</th>
                                    <th>Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tim as $row) { ?>
                                    <tr>
                                        <td scope="row"><?= $row->NAMA_TIM ?></td>
                                        <td><?= $row->BIDANG_LOMBA ?></td>
                                        <td>Rp <?= number_format($total_team->biaya, 0, ',', '.') ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td></td>
                                    <td class="text-right">
                                        <h4>Total Pembayaran</h4>
                                    </td>
                                    <td>
                                        <h3>
                                            Rp <?= number_format($total_bayar->total_bayar, 0, ',', '.') ?>
                                        </h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br><br>
                        Best Regards,<br>
                        <strong>LO-KREATIF TEAM</strong>
                        <div class="mt-4">
                            <center>
                                <span class="d-none d-print-block">Tanggal cetak: <?= date('d M Y h:i:s'); ?></span>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>