<div style="margin-top: 32px;">
    <div style="height: 12px; background: #5050ff;"></div>
    <div style="margin: 32px 56px 0 56px">
        <div style="margin-bottom: 24px;"><strong>Dear <?= $nama ?></strong>,</div>
        <div style="margin-bottom: 8px">
            <span style="font-size: 20px;">
                Segera lakukan pembayaran sesuai pada details pembayaran.
            </span>
        </div>
        <div style="margin-top: 24px;">
            <table style="margin-bottom: 16px;" border=0 cellspacing="0" cellpadding="8">
                <tr style="line-height: 16px;">
                    <td>Payment Method :</td>
                    <?php
                    if ($payment->TYPE == 1) {
                        $type = "E-WALLET";
                    } else if ($payment->TYPE == 2) {
                        $type = "VIRTUAL ACCOUNT";
                    }
                    ?>
                    <td class="columnDist"><?= $payment->METHOD ?> / <?= $type ?></td>
                </tr>
                <tr style="line-height: 16px;">
                    <td>Payment Created :</td>
                    <?php
                    $time = strtotime($payment->CREATED_TIME);

                    $pay_created_time = date('d M Y H:i:s', $time);
                    ?>
                    <td class="columnDist"><?= $pay_created_time ?></td>
                </tr>
            </table>
        </div>
        <div>
            <table class="borderTable" cellspacing="0" cellpadding="8">
                <thead style="font-weight: bold; background-color: #F8F8F8;">
                    <tr>
                        <td>Payment Details</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <tr style="line-height: 16px;">
                        <td>Total Amount :</td>
                        <td class="floatRight">Rp <?= number_format($payment->PAID_AMOUNT, 0, ',', '.') ?></td>
                    </tr>
                    <div id="products"></div>
                </tbody>
            </table>
            <div style="margin-bottom: 8px">
                <span style="font-size: 20px;">
                    Untuk melanjutkan pembayaran, silahkan kunjungi halaman <a href="<?= base_url('payment/details/' . $payment->KODE_PAY) ?>">details pembayaran.</a>.
                </span>
            </div>
            <center>
                <a target="_blank" style="color: #F8F8F8;" class="button" href="<?= base_url('payment/details/' . $payment->KODE_PAY) ?>">Details Pembayaran</a>
            </center>
        </div>
    </div>
</div>