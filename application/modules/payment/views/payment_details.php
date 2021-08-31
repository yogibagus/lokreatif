<?php
if ($payment->TYPE == 1) {
    $type = "E-WALLET";
} else if ($payment->TYPE == 2) {
    $type = "VIRTUAL ACCOUNT";
} else {
    $type = "";
}

?>
<div class="container space-3">
    <div class="d-flex justify-content-center">
        <div class="col-lg-7">
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-title">Selesaikan Pembayaran</h4>
                    <button class="btn btn-primary btn-xs"" role=" button" data-toggle="modal" data-target="#modelId"><i class="fa fa-info-circle" aria-hidden="true"></i> Cara Bayar</button>

                    <!-- Modal -->
                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Cara Bayar</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php foreach ($bank_tut as $row) { ?>
                                        <h4><i class="fa fa-info-circle" aria-hidden="true"></i> <?= $row->NAMA_TUT ?></h4>
                                        <p><strong>Catatan: <?= ($row->CATATAN_TUT != "") ? $row->CATATAN_TUT : "-" ?></strong></p>

                                        <?= $row->DESKRIPSI_TUT ?>
                                        <hr>
                                    <?php } ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-soft-info text-dark" id="alert" role="alert">
                        <strong><i class="fa fa-info-circle" aria-hidden="true"></i></strong>
                        Lakukan pembayaran sebelum batas waktu pembayaran habis.
                    </div>
                    <h3 class="text-center mb-3">Keterangan</h3>
                    <div class="row text-center">
                        <div class="col-lg-6 col-6 mb-2">
                            <span class="font-weight-bold d-block">Transaksi ID:</span>
                            <span class="d-block"><?= $payment->KODE_TRANS ?></span>
                        </div>
                        <div class="col-lg-6 col-6 mb-2">
                            <span class="font-weight-bold d-block">Status Pembayaran:</span>
                            <span id="status-payment" class="badge badge-<?= $status->COLOR_STAT_PAY ?>" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?= $status->KETERANGAN_STAT_PAY ?>"><?= $status->ALIAS_STAT_PAY ?></span>
                        </div>
                        <div class="col-lg-6 col-6 mb-2">
                            <span class="font-weight-bold d-block">Order dibuat oleh:</span>
                            <span class="d-block"><?= $user->NAMA ?></span>
                        </div>
                        <div class="col-lg-6 col-6 mb-2">
                            <span class="font-weight-bold d-block">Waktu order:</span>
                            <?php
                            $time = strtotime($payment->CREATED_TIME);

                            $pay_created_time = date('d M Y H:i:s', $time);
                            ?>
                            <span class="d-block"><?= $pay_created_time ?></span>
                        </div>
                    </div>
                    <hr>

                    <div class="text-center">
                        <h3 class="">TOTAL BAYAR <i class="fa fa-question-circle text-muted" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Sudah termasuk fee"></i></h3>
                        <span class=" h1 text-primary">Rp <?= number_format($payment->PAID_AMOUNT, 0, ',', '.') ?></span>
                        <hr>
                    </div>
                    <div id="payment-info">
                        <?php if ($payment->TYPE == 1) { ?>
                            <?php if ($payment->METHOD == "OVO") { ?>
                                <div class="alert alert-primary" role="alert">
                                    <strong><i class="fa fa-info-circle" aria-hidden="true"></i> </strong> Segera buka aplikasi OVO anda. Kami telah mengirimkan Notification pada OVO anda. <a href="#" class="text-dark">Pelajari lebih lanjut.</a>
                                </div>
                                <center>
                                    <h3>BATAS WAKTU PEMBAYARAN</h3>
                                    <div class="alert alert-soft-primary" role="alert">
                                        <center><strong id="countdown" class="h4">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </strong>
                                        </center>
                                    </div>
                                    <hr>
                                    <h3>PAYMENT METHOD</h3>
                                    <span class="badge badge-info"><?= $type ?></span>
                                    <span class="badge badge-primary"><?= $payment->METHOD ?></span>
                                </center>
                            <?php } else if ($payment->METHOD == "SHOPEEPAY") { ?>
                                <center>
                                    <h3>BATAS WAKTU PEMBAYARAN</h3>
                                    <div class="alert alert-soft-primary" role="alert">
                                        <center><strong id="countdown" class="h4">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </strong>
                                        </center>
                                    </div>
                                    <hr>
                                    <div class="alert alert-soft-primary" role="alert">
                                        <strong><i class="fa fa-info-circle" aria-hidden="true"></i> </strong> Scan QR Code dibawah menggunakan Aplikasi <strong>Shopee</strong> / Aplikasi <strong>E-Wallet</strong> lainnya. <a href="#" class="text-dark">Pelajari lebih lanjut.</a>
                                    </div>
                                    <h3>PAYMENT METHOD</h3>
                                    <span class="badge badge-info"><?= $type ?></span><br>
                                    <span class="badge badge-primary"><?= $payment->METHOD ?></span>
                                    <span class="badge badge-primary">QRIS</span>
                                    <br>
                                    <a href="#"><img src="<?= $payment->WEB_URL ?>" class="img-fluid img-thumbnail mt-3" style="max-width: 270px;" alt="QR Code ShoopePay" data-toggle="modal" data-target="#qrcodezoom"></a>

                                    <!-- Zoom -->
                                    <div class="modal fade" id="qrcodezoom" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Shopee Pay</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-soft-primary" role="alert">
                                                        <strong><i class="fa fa-info-circle" aria-hidden="true"></i> </strong> Buka Aplikasi <strong>Shopee</strong> / Aplikasi <strong>E-Wallet</strong> lainnya. Scan QR Code dibawah. <a href="#" class="text-dark">Pelajari lebih lanjut.</a>
                                                    </div>
                                                    <img src="<?= $payment->WEB_URL ?>" class="img-fluid img-thumbnail" alt="QR Code ShoopePay Zoom" data-toggle="modal" data-target="#qrcodezoom">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <small class="mt-3">Scan this QR Code using ShopeePay / other e-wallet apps.</small>
                                </center>
                            <?php } ?>
                        <?php } ?>

                        <?php if ($payment->TYPE == 2) { ?>
                            <center>
                                <h3>BATAS WAKTU PEMBAYARAN</h3>
                                <div class="alert alert-soft-primary" role="alert">
                                    <center><strong id="countdown" class="h4">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </strong>
                                    </center>
                                </div>
                                <hr>
                                <h3>PAYMENT METHOD</h3>
                                <span class="badge badge-info"><?= $type ?></span><br>
                                <span class="badge badge-primary">BANK <?= $payment->METHOD ?></span>
                                <h4 class="mt-3">VA Number <small><i class="fa fa-question-circle text-muted" data-toggle="tooltip" data-placement="top" title="Virtual Account Number" aria-hidden="true"></i></small></h4>
                                <div class=" input-group mb-3" style="max-width: 300px;">
                                    <input type="text" class="form-control bg-white text-center font-weight-bold" value="<?= $payment->ACC_NUMBER ?>" id="va_number" disabled>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" title="Copy VA Number" onclick="copyInput()" type=" button"><i class="fas fa-copy    "></i></button>
                                    </div>
                                </div>
                            </center>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <div id="checkout-button"></div>
            </div>
        </div>
    </div>
</div>



<script>
    function copyInput() {
        /* Get the text field */
        var copyText = document.getElementById("va_number");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);

        /* Alert the copied text */
        alert("VA Number: " + copyText.value + "\nTelah berhasil di-copy!");
    }
</script>

<script>
    <?php
    $addminute = strtotime("$payment->CREATED_TIME + 1 minute");
    $ovotimelimit = date('Y-m-d H:i:s', $addminute);
    // if e-wallet set limit
    if ($payment->TYPE == 1) {
        if ($payment->METHOD == "OVO") {
            $limit = $ovotimelimit;
        } else {
            $limit = $payment->EXP_TIME;
        }
    } else if ($payment->TYPE == 2) {
        $limit = $payment->EXP_TIME;
    }
    ?>
    // mm/dd/yy
    var end = new Date('<?= $limit ?>');
    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        if (distance < 0) {

            clearInterval(timer);
            $("#countdown").html("<strong>EXPIRED!!</strong>");
            $("#payment-info").html("<center><strong>Batas waktu telah habis.</strong></center>");
            $("#alert").addClass("alert-soft-danger");
            $("#alert").html("<strong>Batas waktu telah habis</strong>");
            $("#checkout-button").html('<a class="btn btn-xs btn-primary" href="<?= base_url('payment/checkout/' . $payment->KODE_TRANS) ?>" role="button"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Halaman Checkout</a>');
            document.getElementById('alert').innerHTML = 'Waktu pembayaran telah habis, ulangi proses pembayaran pada halaman <a href="<?= base_url('payment/checkout/' . $payment->KODE_TRANS) ?>">checkout.</a>';
            // document.getElementById('ket').innerHTML = '*Batas waktu telah habis, ulangi proses pembayaran dari awal.';
            // document.getElementById('status_message').innerHTML = 'Batas waktu telah habis, ulangi proses pembayaran dari awal.';
            // document.getElementById('va').innerHTML = 'EXPIRED!';
            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        document.getElementById('countdown').innerHTML = days + 'hari ';
        document.getElementById('countdown').innerHTML += hours + 'jam ';
        document.getElementById('countdown').innerHTML += minutes + 'mnt ';
        document.getElementById('countdown').innerHTML += seconds + 'dtk';
    }

    timer = setInterval(showRemaining, 1000);
</script>

<script>
    setInterval(function() {
        // this code runs every second 
        jQuery.ajax({
            url: "<?= base_url('payment/get_payment_stat/' . $payment->KODE_PAY) ?>",
            type: "GET",
            success: function(data) {
                if (data == 1) {
                    // Send new refresh request in 1 sec:
                    $("#payment-info").html("<center><strong>Pembayaran sukses.</strong></center>");
                    $("#status-payment").removeClass(" badge-warning");
                    $("#status-payment").addClass(" badge-success");
                    $("#status-payment").text("Pembayaran Sukses");
                    $("#alert").html("<strong>Selamat!</strong> Pembayaran anda telah berhasil divalidasi.");
                    location.reload();
                } else {

                }
            }
        });
    }, 6000);
</script>