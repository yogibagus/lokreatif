

<?php if ($form != null) { ?>
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <span class="font-weight-bold h4">Preview Berkas:</span>
            <a target="_blank" id="" class="btn btn-primary btn-sm" href="<?= base_url(); ?>berkas/pendaftaran/kompetisi/lokreatif/<?= $pendaftaran->KODE_USER; ?>/<?= $form ?>" role=" button"><i class="tio-open-in-new"></i> Bukta di tab baru</a>
        </div>
        <div class="responsive-iframe">
            <iframe src="<?= base_url(); ?>berkas/pendaftaran/kompetisi/lokreatif/<?= $pendaftaran->KODE_USER; ?>/<?= $form ?>" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
<?php } else { ?>
    <center>
        <div class="alert alert-danger" role="alert">
            Berkas tidak ditemukan.
        </div>
    </center>
<?php } ?>