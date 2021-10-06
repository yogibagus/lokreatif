<!-- Breadcrumb Section -->
<div class="container py-3 space-top-1">
  <div class="row align-items-lg-center">
    <div class="col-lg mb-2 mb-lg-0">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-no-gutter font-size-1 mb-0">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= site_url('kegiatan') ?>">Kegiatan</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?= $kegiatan->JUDUL;?></li>
        </ol>
      </nav>
      <!-- End Breadcrumb -->
    </div>

    <div class="col-lg-auto">
      <a class="btn btn-sm btn-ghost-secondary float-right" href="https://api.whatsapp.com/send?text=Hai, cek informasi penyelenggara <?= ucwords(strtolower($kegiatan->JUDUL)) ?> kami, lebih detail di <?php echo base_url(uri_string()); ?>" target="_blank">
        <i class="fab fa-whatsapp mr-2"></i> Share
      </a>
    </div>
  </div>
  <!-- End Row -->
</div>
<!-- End Breadcrumb Section -->
<!-- About Section -->
<div id="tentang-section" class="container">
  <h2><?= $kegiatan->JUDUL;?></h2>

  <div class="row mb-<?= $CI->agent->is_mobile() ? '0' : '5';?>">
    <div class="col-md-3 order-md-2 mb-3 mb-md-0">
      <div class="pl-md-4">
        <ul class="list-unstyled list-article">
          <li>
            <?php if($this->session->userdata('logged_in') == FALSE || !$this->session->userdata('logged_in')) :?>
              <a class="btn btn-sm btn-outline-primary mb-1 mb-sm-0 btn-block" href="<?= site_url('login');?>">
                <i class="fas fa-plus fa-sm mr-1"></i> Login untuk daftar
              </a>
            <?php else:?>
              <?php if($kegiatan->STATUS_KEGIATAN == 1):?>
                <a class="btn btn-sm btn-outline-primary mb-1 mb-sm-0 btn-block" href="<?= site_url('daftar/'.$kegiatan->KODE_KEGIATAN);?>">
                  <?php if($daftar == true):?><i class="fas fa-check fa-sm mr-1"></i> Telah mendaftar <?php else:?><i class="fas fa-plus fa-sm mr-1"></i> Daftar<?php endif;?>
                </a>
              <?php elseif ($kegiatan->STATUS_KEGIATAN != 1) :?>
                <a class="btn btn-sm btn-outline-primary mb-1 mb-sm-0 btn-block">
                  <?= ($kegiatan->STATUS_KEGIATAN == 0 ? 'Belum dibuka' : 'Telah berakhir');?>
                </a>
              <?php endif;?>
            <?php endif;?>
          </li>
          <li>
            <span class="h5 d-block">Tanggal</span>
            <span class="d-block font-size-1"><?= date("d F Y", strtotime($kegiatan->TANGGAL));?>, <?= $kegiatan->WAKTU;?> WIB</span>
          </li>

          <li>
            <span class="h5 d-block">FEE</span>
            <span class="d-block font-size-1"><?= $kegiatan->BAYAR == 0 ? 'FREE': 'Rp.'.($CI->M_kegiatan->get_tiketRange($kegiatan->KODE_KEGIATAN)->low).' s/d '.'Rp.'.($CI->M_kegiatan->get_tiketRange($kegiatan->KODE_KEGIATAN)->high) ;?></span>
          </li>

          <li>
            <span class="h5 d-block">PLATFORM</span>
            <span class="d-block font-size-1"><span class="badge badge-<?= $kegiatan->ONLINE == 1 ? 'primary' : 'secondary';?>"><?= $kegiatan->ONLINE == 1 ? 'ONLINE' : 'OFFLINE';?></span></span>
          </li>

          <li>
            <span class="h5 d-block">MEDIA / TEMPAT</span>
            <span class="d-block font-size-1"><?= $kegiatan->MEDIA;?></span>
          </li>
        </ul>
      </div>
    </div>

    <div class="col-md-9">
      <div class="my-4">
        <div class="row">
          <div class="col-sm-5 col-lg-4 mb-3 mb-sm-0">
            <img class="card-img" src="<?= base_url();?><?= $kegiatan->POSTER == null ? "assets/frontend/img/400x500/img14.jpg" : "berkas/kegiatan/".$kegiatan->KODE_KEGIATAN."/POSTER/".$kegiatan->POSTER;?>" alt="poster">
          </div>
          <div class="col-sm-7 col-lg-8">
            <?= $kegiatan->DESKRIPSI;?>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- End Row -->
</div>
<!-- Tentang Section -->

<!-- Divider -->
<div class="container">
  <hr class="my-<?= $CI->agent->is_mobile() ? '2' : '10';?>">
</div>
<!-- End Divider -->
