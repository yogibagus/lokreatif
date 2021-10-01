<?php if ($berkas == false) { ?>
    <center>
        <div class="alert alert-soft-danger" role="alert">
            Tim belum mengunggah karya.
        </div>
    </center>
<?php } else { ?>
    <div class="container">
        <div class="row border mb-3">
            <div class="col-lg-6 mt-2">
                <label class="font-weight-bold" for="">Judul Karya:</label><br>
                <p><?= $berkas->JUDUL ?></p>
            </div>
            <div class="col-lg-6 mt-2 border-left">
                <label class="font-weight-bold" for="">Bidang Lomba:</label><br>
                <p><?= $berkas->BIDANG_LOMBA ?></p>
            </div>
            <!-- Only Show on Videio Pendek, unjuk talent, tiktok -->
            <?php if ($berkas->ID_BIDANG == 3 || $berkas->ID_BIDANG == 13 || $berkas->ID_BIDANG == 11) { ?>
                <div class="col-lg-12 mt-2">
                    <hr>
                    <label class="font-weight-bold" for="">Google Drive:</label><br>
                    <a class="btn btn-success btn-sm mb-3" target="_blank" href="<?= $berkas->LINK_DRIVE ?>" role="button"><i class="tio-google-drive"></i> Berkas Karya</a>
                </div>
            <?php } ?>
        </div>

        <!-- PDF 1=Aplikasi, 8=Idebisnis, 10=game -->
        <?php if ($berkas->ID_BIDANG == 1 || $berkas->ID_BIDANG == 8 || $berkas->ID_BIDANG == 10) { ?>
            <div class="d-flex justify-content-between mb-2">
                <label class="font-weight-bold" for="">Preview Karya:</label>
                <a class="btn btn-primary btn-sm" target="_blank" href="<?= base_url(); ?>berkas/kompetisi/karya/<?= preg_replace("/[^a-zA-Z]+/", "_", $berkas->BIDANG_LOMBA); ?>/<?= preg_replace("/[^a-zA-Z]+/", "_", $berkas->NAMA_TIM); ?>_<?= $berkas->KODE_USER ?>/<?= $berkas->FILE; ?>" role="button"><i class="tio-open-in-new"></i> Buka di tab baru</a>
            </div>
            <div class="responsive-iframe">
                <iframe src="<?= base_url(); ?>berkas/kompetisi/karya/<?= preg_replace("/[^a-zA-Z]+/", "_", $berkas->BIDANG_LOMBA); ?>/<?= preg_replace("/[^a-zA-Z]+/", "_", $berkas->NAMA_TIM); ?>_<?= $berkas->KODE_USER ?>/<?= $berkas->FILE; ?>" frameborder="0" allowfullscreen></iframe>
            </div>
        <?php } ?>

        <!-- VIDEO 3=videopendek, 13=unjuktalent -->
        <?php if ($berkas->ID_BIDANG == 3 || $berkas->ID_BIDANG == 13) { ?>
            <div class="d-flex justify-content-between">
                <label class="font-weight-bold" for="">Preview Karya:</label>
                <a class="btn btn-danger btn-sm" target="_blank" href="<?= $berkas->LINK ?>" role="button"><i class="tio-youtube"></i> Buka di YouTube</a>
            </div>
            <div class="responsive-iframe">
                <iframe src="<?= str_replace("https://www.youtube.com/watch?v=", "https://www.youtube.com/embed/", "$berkas->LINK") ?>" frameborder="0" allowfullscreen></iframe>
            </div>
        <?php } ?>

        <!-- VIDEO GDRIVE 11=tiktok -->
        <?php if ($berkas->ID_BIDANG == 11) { ?>
            <div class="">
                <label class="font-weight-bold" for="">Preview Karya:</label><br>
                <a class="btn btn-primary btn-sm mt-2" target="_blank" href="<?= $berkas->LINK ?>" role="button"><i class="tio-slideshow-outlined"></i> Buka di Tiktok</a>
            </div>
        <?php } ?>

        <!-- JPG 4=desainposter, 9=fotografi -->
        <?php if ($berkas->ID_BIDANG == 4 || $berkas->ID_BIDANG == 9) { ?>
            <div class="d-flex justify-content-between">
                <label class="font-weight-bold" for="">Preview Karya:</label>
                <a class="btn btn-primary btn-sm" target="_blank" href="<?= base_url(); ?>berkas/kompetisi/karya/<?= preg_replace("/[^a-zA-Z]+/", "_", $berkas->BIDANG_LOMBA); ?>/<?= preg_replace("/[^a-zA-Z]+/", "_", $berkas->NAMA_TIM); ?>_<?= $berkas->KODE_USER ?>/<?= $berkas->FILE; ?>" role="button"><i class="tio-open-in-new"></i> Buka di tab baru</a>
            </div>
            <img src="<?= base_url(); ?>berkas/kompetisi/karya/<?= preg_replace("/[^a-zA-Z]+/", "_", $berkas->BIDANG_LOMBA); ?>/<?= preg_replace("/[^a-zA-Z]+/", "_", $berkas->NAMA_TIM); ?>_<?= $berkas->KODE_USER ?>/<?= $berkas->FILE; ?>" class="img-fluid img-thumbnail rounded" alt="">
        <?php } ?>
    </div>
<?php } ?>