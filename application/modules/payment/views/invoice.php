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
                <div class="card-header">
                    <h4>Invoice</h4>
                    <button type="button" class="btn btn-xs btn-primary" onclick="printDiv('printableArea')"><i class="fa fa-print" aria-hidden="true"></i> Cetak Invoice</button>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-lg-6 col-6">
                            <span><strong>#<?= $kode_trans ?></strong></span><br>
                            <span><?= $nama ?></span><br>
                            <span><?= $user->EMAIL ?></span><br>
                        </div>
                        <div class="col-lg-6  col-6">
                            <img src="<?= base_url('assets/logo-ts.png') ?>" style="max-width: 200px;" class="img-fluid" alt="">
                            <p>
                                APTISI 7 JATIM <br>
                                Kota Malang, Jawa Timur - Indonesia</p>
                        </div>
                    </div>
                    <hr>
                    <p class="mt-3">Pembayaran Anda menggunakan <?= $payment->NAMA_PAY_METHOD ?> berhasil. Berikut rincian pembayaran Anda:</p>
                    <div class="mt-4">
                        <table class="table table-sm table-borderless col-8">
                            <tbody>
                                <tr>
                                    <td>Total Bayar</td>
                                    <td>:</td>
                                    <td><strong>Rp <?= number_format($total_bayar->total_bayar, 0, ',', '.')  ?></strong></td>
                                </tr>
                                <br>
                                <tr>
                                    <td>Metode Pembayaran</td>
                                    <td>:</td>
                                    <td><strong><?= $payment->NAMA_PAY_METHOD ?></strong></td>
                                </tr>
                                <br>
                                <tr>
                                    <td>Waktu Pembayaran</td>
                                    <td>:</td>
                                    <td><strong><?= $payment->LOG_TIME ?></strong></td>
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
                                        <h4>Total Biaya</h4>
                                    </td>
                                    <td>
                                        <h4>
                                            Rp <?= number_format($total_bayar->total_bayar, 0, ',', '.') ?>
                                        </h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br><br>
                        Best Regards,<br>
                        <strong>LO-KREATIF</strong>
                        <div class="mt-4">
                            <center>
                                <span class="d-none d-print-block">Tgl cetak: <?= date('d-M-Y h:i:s'); ?></span>
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