<?php if ($form != null) { ?>
    <div class="container">
        <?php
        $check_form = $form;
        $search = "instagram.com";
        $search2 = ".pdf";
        if (preg_match("/{$search}/i", $check_form) == true) {
        ?>
            <?php
            $search3 = "?";
            if (strpos($check_form, $search3) !== false) {
                $form = explode($search3, $check_form);
            ?>
                <center>
                    <div class="" style="max-width:750px">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="font-weight-bold h4">Preview Feed:</span>
                            <a target="_blank" id="" class="btn btn-primary btn-xs" href="<?= $form[0] ?>" role=" button"><i class="tio-instagram"></i> Buka di tab baru</a>
                        </div>
                        <div class="responsive-iframe-ig">
                            <iframe class="shadow-sm" src="<?= $form[0] . "embed" ?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </center>
            <?php } else {
                $last_char = substr($form, -1); 
                if($last_char == "/"){
                    $last_char = "";
                }else{
                    $last_char = "/";
                }
                ?>
                <center>
                    <div class="" style="max-width:750px">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="font-weight-bold h4">Preview Feed:</span>
                            <a target="_blank" id="" class="btn btn-primary btn-xs" href="<?= $form ?>" role=" button"><i class="tio-instagram"></i> Buka di tab baru</a>
                        </div>
                        <div class="responsive-iframe-ig">
                            <iframe class="shadow-sm" src="<?= $form . "$last_char" . "embed" ?> " frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </center>
            <?php } ?>
        <?php } elseif (preg_match("/{$search2}/i", $check_form) == false) { ?>

        <?php } else { ?>
            <div class="d-flex justify-content-between mb-3">
                <span class="font-weight-bold h4">Preview Berkas:</span>
                <a target="_blank" id="" class="btn btn-primary btn-sm" href="<?= base_url(); ?>berkas/pendaftaran/kompetisi/lokreatif/<?= $pendaftaran->KODE_USER; ?>/<?= $form ?>" role=" button"><i class="tio-open-in-new"></i> Buka di tab baru</a>
            </div>
            <div class="responsive-iframe">
                <iframe src="<?= base_url(); ?>berkas/pendaftaran/kompetisi/lokreatif/<?= $pendaftaran->KODE_USER; ?>/<?= $form ?>" frameborder="0" allowfullscreen></iframe>
            </div>
        <?php } ?>
    </div>
<?php } else { ?>
    <center>
        <div class="alert alert-danger" role="alert">
            Berkas tidak ditemukan.
        </div>
    </center>
<?php } ?>