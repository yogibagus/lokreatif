<div class="container space-3">
    <div class="d-flex justify-content-center">
        <div class="col-lg-9">
            <!-- start center -->
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-title">Checkout</h4>
                </div>
                <div class="card-body">
                    <?php if ($this->session->userdata('role') == 1) { ?>
                        <?php if ($payment_history->belum_selesai > 0) { ?>
                            <div class="alert alert-soft-info text-dark" role="alert">
                                <strong><i class="fa fa-info-circle" aria-hidden="true"></i> Hei! </strong>
                                Anda memiliki <strong><?= $payment_history->belum_selesai ?></strong> riwayat pembayaran yang belum anda selesaikan. <a href="<?= base_url('peserta/riwayat-pembayaran') ?>">Lanjutkan pembayaran sebelumnya.</a>
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-secondary" role="alert">
                                <strong><i class="fa fa-info-circle" aria-hidden="true"></i></strong>
                                Segera lakukan pembayaran menggunakan metode pembayaran yang telah tersedia.
                            </div>
                        <?php } ?>
                    <?php } else if ($this->session->userdata('role') == 3) { ?>
                        <div class="alert alert-secondary" role="alert">
                            <strong><i class="fa fa-info-circle" aria-hidden="true"></i></strong>
                            Segera lakukan pembayaran menggunakan metode pembayaran yang telah tersedia.
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="row row-eq-height">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Nama Tim</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-md-flex">
                                <div class="overflow-auto p-3 mb-3 mb-md-0 bg-light rounded " style="max-height: 180px; width:100%">
                                    <?php
                                    foreach ($tim as $item) {
                                        echo '
                                    <h4><li>' . $item->NAMA_TIM . '</li></h4><br>
                                ';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Ringkasan Pembayaran</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h5>Subtotal</h5>
                                <ul class="list-unstyled">
                                    <div class="d-flex justify-content-between">
                                        <li><?= $total_team->total_team ?> Tim x Rp <?= number_format($total_team->biaya, 0, ',', '.') ?></li>
                                        <li>Rp <?= number_format($total_bayar->total_bayar, 0, ',', '.') ?></li>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <li>Fee <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Fee 1.5% E-Wallet dan +4000 Virtual Account"></i></li>
                                        <li>Rp <span id="fee">0</span></li>
                                    </div>
                                </ul>
                            </div>
                            <hr>
                            <div class="mb-4 list-unstyled">
                                <div class="d-flex justify-content-between">
                                    <h2>Total</h2>
                                    <h2 class="text-primary">Rp <span id="total_amount"><?= number_format($total_bayar->total_bayar, 0, ',', '.') ?></span></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="card-title">Metode Pembayaran</h4>
                </div>
                <div class="card-body">
                    <!-- Type of Listing -->
                    <div class="mb-10">
                        <!-- Nav -->
                        <div class="text-center">
                            <ul class="nav nav-segment nav-pills scrollbar-horizontal mb-7" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="ewallet-tab" data-toggle="pill" href="#tab-menu-ewallet" role="tab" aria-controls="tab-menu-ewallet" aria-selected="true">E-WALLET</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="va-tab" data-toggle="pill" href="#tab-menu-va" role="tab" aria-controls="tab-menu-va" aria-selected="false">VIRTUAL ACCOUNT</a>
                                </li>
                            </ul>
                        </div>
                        <!-- End Nav -->

                        <!-- Tab Content <?= base_url("payment/pay") ?> -->
                        <form id='form' action="/" method="post">
                            <input type="hidden" name="kode_trans" id="kode_trans" value="<?= $kode_trans ?>">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab-menu-ewallet" role="tabpanel" aria-labelledby="pills-one-code-features-example1-tab">
                                    <style>
                                        .fit-image {
                                            width: 130px;
                                            object-fit: cover;
                                            height: 70px;
                                            /* only if you want fixed height */
                                        }
                                    </style>
                                    <div class="alert alert-soft-primary" role="alert">
                                        <strong><i class="fa fa-info-circle" aria-hidden="true"></i> </strong>
                                        Siapkan Aplikasi E-Wallet Anda agar proses pembayaran lebih cepat.
                                    </div>
                                    <!-- Radio Checkbox Group -->
                                    <div class="row mx-n2">
                                        <div class="col-6 col-md-3 px-2 mb-3 mb-md-0">
                                            <div class="custom-control custom-radio custom-control-inline checkbox-outline checkbox-icon text-center w-100 h-100">
                                                <input type="radio" id="typeOfListingRadio1" name="method" class="custom-control-input checkbox-outline-input checkbox-icon-input" value="EWALLET_OVO" required>
                                                <label class="checkbox-outline-label checkbox-icon-label w-100 rounded py-3 px-1 mb-0" for="typeOfListingRadio1">
                                                    <img class="img-fluid w-90 fit-image" src="https://image.cermati.com/c_fit,fl_progressive,h_240,q_80,w_360/pm2gnkl5edgago9h4lho.jpg" alt="OVO">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 px-2 mb-3 mb-md-0">
                                            <div class="custom-control custom-radio custom-control-inline checkbox-outline checkbox-icon text-center w-100 h-100">
                                                <input type="radio" id="typeOfListingRadio2" name="method" class="custom-control-input checkbox-outline-input checkbox-icon-input" value="EWALLET_DANA">
                                                <label class="checkbox-outline-label checkbox-icon-label w-100 rounded py-3 px-1 mb-0" for="typeOfListingRadio2">
                                                    <img class="img-fluid w-90 fit-image" src="https://1.bp.blogspot.com/-LDwtS_oxYgg/XO67MmzGN7I/AAAAAAAAADI/hrSqgCRod3oIS6NtwjOqdY0okl8hwyi6gCLcBGAs/s1600/logo%2Bdana%2Bdompet%2Bdigital%2BPNG.png" alt="DANA">
                                                </label>
                                            </div>
                                        </div>
                                        <!-- <div class="col-6 col-md-3 px-2 mb-3 mb-md-0">
                                            <div class="custom-control custom-radio custom-control-inline checkbox-outline checkbox-icon text-center w-100 h-100">
                                                <input type="radio" id="typeOfListingRadio3" name="method" class="custom-control-input checkbox-outline-input checkbox-icon-input" value="EWALLET_SHOPEEPAY">
                                                <label class="checkbox-outline-label checkbox-icon-label w-100 rounded py-3 px-1 mb-0" for="typeOfListingRadio3">
                                                    <img class="img-fluid w-90 fit-image" src="https://kampungbahasajogja.net/assets/img/about/shopeepay.png" alt="SHOPEEPAY">
                                                </label>
                                            </div>
                                        </div> -->
                                        <div class="col-6 col-md-3 px-2 mb-3 mb-md-0">
                                            <div class="custom-control custom-radio custom-control-inline checkbox-outline checkbox-icon text-center w-100 h-100">
                                                <input type="radio" id="typeOfListingRadio4" name="method" class="custom-control-input checkbox-outline-input checkbox-icon-input" value="EWALLET_LINKAJA">
                                                <label class="checkbox-outline-label checkbox-icon-label w-100 rounded py-3 px-1 mb-0" for="typeOfListingRadio4">
                                                    <img class="img-fluid w-90 fit-image" src="https://vectorlogo4u.com/wp-content/uploads/2019/03/link-aja-logo-vector.png" alt="LINKAJA">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Alert -->
                                    <?php if ($is_mobile) { ?>
                                        <div id="shopeepay-alert" class="alert alert-warning text-center rounded-0 mt-3" role="alert">
                                            <strong><i class="fa fa-info-circle" aria-hidden="true"></i></strong> Anda terdeteksi menggunakan perangkat <strong>Mobile</strong>, pembayaran melalui <strong>ShoopePay</strong> akan diarahkan ke <strong>Aplikasi Shopee</strong> secara langsung. <a href="#">Pelajari selengkapnya.</a>
                                        </div>
                                    <?php } ?>
                                    <!-- End Alert -->
                                    <label for="basic-url" class="form-label mt-3 text-method" id="">OVO Number:</label>
                                    <!-- Input Group -->
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text p-2">
                                                +62
                                            </span>
                                        </div>
                                        <input type="number" class="form-control" oninput="requiredAlertMobile()" placeholder="XXX-XXXX-XXXX" name="mobile" id="mobile" value="" required>
                                    </div>
                                    <small class="text-muted" id="required-alert-wallet">*) Harap masukan Nomor E-Wallet anda pada form diatas.</small>
                                    <!-- End Input Group -->
                                </div>

                                <div class="tab-pane fade" id="tab-menu-va" role="tabpanel" aria-labelledby="pills-two-code-features-example1-tab">
                                    <!-- Radio Checkbox Group -->
                                    <div class="row mx-n2">
                                        <div class="col-6 col-md-3 px-2 mb-3 mb-md-0">
                                            <div class="custom-control custom-radio custom-control-inline checkbox-outline checkbox-icon text-center w-100 h-100">
                                                <input type="radio" id="vamandiri" name="method" class="custom-control-input checkbox-outline-input checkbox-icon-input" value="VA_MANDIRI">
                                                <label class="checkbox-outline-label checkbox-icon-label w-100 rounded py-3 px-1 mb-0" for="vamandiri">
                                                    <img class="img-fluid w-90 fit-image" src="https://brandeps.com/logo-download/B/Bank-Mandiri-logo-vector-01.svg" alt="MANDIRI">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 px-2 mb-3 mb-md-0">
                                            <div class="custom-control custom-radio custom-control-inline checkbox-outline checkbox-icon text-center w-100 h-100">
                                                <input type="radio" id="vabni" name="method" class="custom-control-input checkbox-outline-input checkbox-icon-input" value="VA_BNI">
                                                <label class="checkbox-outline-label checkbox-icon-label w-100 rounded py-3 px-1 mb-0" for="vabni">
                                                    <img class="img-fluid w-90 fit-image" src="https://i.pinimg.com/originals/36/38/43/36384348ef9d7bfff66da6da9e975d56.png" alt="BNI">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 px-2">
                                            <div class="custom-control custom-radio custom-control-inline checkbox-outline checkbox-icon text-center w-100 h-100">
                                                <input type="radio" id="vabri" name="method" class="custom-control-input checkbox-outline-input checkbox-icon-input" value="VA_BRI">
                                                <label class="checkbox-outline-label checkbox-icon-label w-100 rounded py-3 px-1 mb-0" for="vabri">
                                                    <img class="img-fluid w-90 fit-image" src="https://i.ibb.co/Hg1gDdM/images-q-tbn-ANd9-Gc-TIan-Xv-IR5-Wnc-Pv461-AIGT8-FL7t-JJk-A7z-Ui-Dw-usqp-CAU.png" alt="BRI">
                                                </label>
                                            </div>
                                        </div>
                                        <!-- <div class="col-6 col-md-3 px-2">
                                            <div class="custom-control custom-radio custom-control-inline checkbox-outline checkbox-icon text-center w-100 h-100">
                                                <input type="radio" id="vabca" name="method" class="custom-control-input checkbox-outline-input checkbox-icon-input" value="VA_BCA">
                                                <label class="checkbox-outline-label checkbox-icon-label w-100 rounded py-3 px-1 mb-0" for="vabca">
                                                    <img class="img-fluid w-90 fit-image" src="https://cdn.freebiesupply.com/logos/thumbs/2x/bca-bank-central-asia-logo.png" alt="BCA">
                                                </label>
                                            </div>
                                        </div> -->

                                        <div class="col-6 col-md-3 px-2">
                                            <div class="custom-control custom-radio custom-control-inline checkbox-outline checkbox-icon text-center w-100 h-100">
                                                <input type="radio" id="vapermata" name="method" class="custom-control-input checkbox-outline-input checkbox-icon-input" value="VA_PERMATA">
                                                <label class="checkbox-outline-label checkbox-icon-label w-100 rounded py-3 px-1 mb-0" for="vapermata">
                                                    <img class="img-fluid w-90 fit-image" src="https://1.bp.blogspot.com/-tZkp5O70Rqo/XAJ7BwL9_lI/AAAAAAAAAZw/DGusJ0Y5XL84uKmWpnPJ0kQPOjabtqMTwCPcBGAYYCw/s1600/Lowongan%2BKerja%2BTerbaru%2BBank%2BPermata.png" alt="PERMATA">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-muted" id="required-alert-va">*) Pilih salah satu metode pembayaran diatas.</small>
                                </div>
                            </div>
                            <!-- End Tab Content -->

                            <button type="submit" name="" id="pay-button" class="btn btn-primary btn-block mt-3">Bayar Sekarang</button>
                        </form>
                    </div>
                    <!-- End Type of Listing -->
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function format_rupiah(angka) {
                var reverse = angka.toString().split('').reverse().join(''),
                    ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
                return ribuan;
            }
            $("#va-tab").click(function() {
                $("input[name='method']").removeAttr('checked')

                // set fee
                var amount = 4000 + parseInt(<?= $total_bayar->total_bayar ?>);
                var fee = amount - parseInt(<?= $total_bayar->total_bayar ?>);
                $('#total_amount').text(format_rupiah(amount));
                $('#fee').text(format_rupiah(fee));
            });
            $("#ewallet-tab").click(function() {
                $("input[name='method']").removeAttr('checked')

                // set fee
                var amount = Math.ceil(100 / 98.5 * parseInt(<?= $total_bayar->total_bayar ?>));
                var new_amount = Math.ceil(amount / 1000) * 1000;
                var fee = new_amount - parseInt(<?= $total_bayar->total_bayar ?>);
                $('#total_amount').text(format_rupiah(new_amount));
                $('#fee').text(format_rupiah(fee));
            });
        });
    </script>

    <script>
        function requiredAlertMobile() {
            $("#required-alert-wallet").hide();
            if ($('#mobile').val() == "") {
                $("#required-alert-wallet").show();
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('form').submit(function(event) {
                // set interval redirect
                setInterval(function() {
                    window.location.replace("<?= $redirect_url ?>");
                }, 3000);
                var method = $('input[name=method]:checked').val();
                var arr = method.split("_");
                if (arr[0] == "EWALLET") {
                    var mobile = $("#mobile").val();
                    // number format lenght
                    if (mobile.length >= 9 && mobile.length <= 14) {
                        $('#pay-button').prop("disabled", true);
                        // add spinner to button
                        $('#pay-button').html(
                            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading, please wait...`
                        );
                        return;
                    }
                    alert("Wrong format number.");
                } else {
                    $('#pay-button').prop("disabled", true);
                    // add spinner to button
                    $('#pay-button').html(
                        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading, please wait...`
                    );
                    return;
                }

                event.preventDefault();
            });
        });
    </script>

    <script>
        // check radio ewaller
        $("input[name='method']").on('change', function() {
            // show or hide alert
            var method = $('input[name=method]:checked').val();
            var arr = method.split("_");
            if (arr[1] == "LINKAJA" || arr[1] == "DANA") {
                $("#form").attr('target', '_blank');
            } else {
                $("#form").removeAttr('target');
            }
            if (arr[0] == "EWALLET") {
                // add required input mobile
                $('#mobile').prop('required', true);
                // change method text
                $('.text-method').text(arr[1] + " Number:");
            } else {
                $('#mobile').prop('required', false);
                // change method text
                $('.text-method').text("Nama:");
            }
        });
    </script>
</div>
<footer class="py-3">
    <center>APTISI VII - LO-Kreatif 2021 © All right reserved</center>
</footer>