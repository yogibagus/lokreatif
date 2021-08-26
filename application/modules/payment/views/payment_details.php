<div class="container space-3">
    <div class="d-flex justify-content-center">
        <div class="col-lg-7">
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-title">Selesaikan Pembayaran - <?= $payment->KODE_TRANS ?></h4>
                    <a name="" id="" class="btn btn-primary btn-xs" href="#" role="button"><i class="fa fa-info-circle" aria-hidden="true"></i> Pelajari</a>
                </div>
                <div class="card-body">
                    <div class="alert alert-soft-info text-dark" role="alert">
                        <strong><i class="fa fa-info-circle" aria-hidden="true"></i></strong>
                        Lakukan pembayaran sebelum batas waktu pembayaran habis.
                    </div>

                    <hr>

                    <center>
                        <h3 class="">TOTAL BAYAR <i class="fa fa-question-circle text-muted" aria-hidden="true" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Sudah termasuk fee"></i></h3>
                        <span class=" h1 text-primary">Rp <?= number_format($payment->PAID_AMOUNT, 0, ',', '.') ?></span>
                        <hr>
                        <?php if ($payment->TYPE == 1) { ?>
                        <?php } ?>

                        <?php if ($payment->TYPE == 2) { ?>
                            <h3>PAYMENT METHOD</h3>
                            <span class="badge badge-primary"><?= $payment->METHOD ?></span>
                        <?php } ?>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>