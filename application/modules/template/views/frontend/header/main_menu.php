<div id="navBar" class="collapse navbar-collapse navbar-nav-wrap-collapse">
  <div class="navbar-body header-abs-top-inner">
    <ul class="navbar-nav">
      <!-- Home -->
      <li class="navbar-nav-item">
        <a class="nav-link" href="<?= base_url() ?>">Beranda</a>
      </li>
      <!-- End Home -->

      

      <!-- Informasi -->
      <li class="hs-has-sub-menu navbar-nav-item">
        <a id="pengumumanMenu" class="hs-mega-menu-invoker nav-link nav-link-toggle " href="javascript:;" aria-haspopup="true" aria-expanded="false" aria-labelledby="pengumumanSubMenu">Informasi Lomba</a>

        <!-- Blog - Submenu -->
        <div id="pengumumanSubMenu" class="hs-sub-menu dropdown-menu" aria-labelledby="pengumumanMenu" style="min-width: 230px;">
          <a class="dropdown-item" href="<?= site_url('statistik') ?>">Statistik</a>
          <a class="dropdown-item" href="<?= site_url('jadwal') ?>">Jadwal</a>
          <a class="dropdown-item" href="<?= site_url('bidang-lomba') ?>">Bidang lomba</a>
          <a class="dropdown-item" href="<?= site_url('tentang-juri') ?>">Juri</a>
        </div>
        <!-- End Submenu -->
      </li>
      <!-- End Informasi -->

      <!-- Layanan -->
      <li class="hs-has-mega-menu navbar-nav-item"
          data-hs-mega-menu-item-options='{
            "desktop": {
              "position": "right",
              "maxWidth": "260px"
            }
          }'>
        <a id="docsMegaMenu" class="hs-mega-menu-invoker nav-link nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false">Layanan</a>

        <!-- Layanan - Submenu -->
        <div class="hs-mega-menu dropdown-menu" aria-labelledby="docsMegaMenu" style="min-width: 330px;">
          <!-- Promo Item -->
          <div class="navbar-promo-item">
            <a class="navbar-promo-link" href="<?= site_url('pengumuman');?>">
              <div class="media align-items-center">
                <img class="navbar-promo-icon" src="<?= base_url();?>assets/frontend/svg/icons/icon-1.svg" alt="SVG">
                <div class="media-body">
                  <span class="navbar-promo-title">Pengumuman</span>
                  <small class="navbar-promo-text">Press release</small>
                </div>
              </div>
            </a>
          </div>
          <!-- End Promo Item -->

          <!-- Promo Item -->
          <div class="navbar-promo-item">
            <a class="navbar-promo-link" href="<?= site_url('unduhan');?>">
              <div class="media align-items-center">
                <img class="navbar-promo-icon" src="<?= base_url();?>assets/frontend/svg/icons/icon-2.svg" alt="SVG">
                <div class="media-body">
                  <span class="navbar-promo-title">Unduhan</span>
                  <small class="navbar-promo-text">Unduh berkas</small>
                </div>
              </div>
            </a>
          </div>
          <!-- End Promo Item -->

          <div class="navbar-promo-footer">
            <!-- List -->
            <div class="row no-gutters">
              <div class="col-6">
                <div class="navbar-promo-footer-item">
                  <span class="navbar-promo-footer-text">Kesulitan?</span>
                  <a class="navbar-promo-footer-text" href="<?= site_url('pusat-bantuan');?>"> Pusat bantuan</a>
                </div>
              </div>
              <div class="col-6 navbar-promo-footer-ver-divider">
                <div class="navbar-promo-footer-item">
                  <span class="navbar-promo-footer-text">Pertanyaan?</span>
                  <a class="navbar-promo-footer-text" href="<?= site_url('hubungi-kami');?>"> Hubungi Kami</a>
                </div>
              </div>
            </div>
            <!-- End List -->
          </div>
        </div>
        <!-- End Layanan - Submenu -->
      </li>
      <!-- End Layanan -->

      <!-- Kegiatan -->
      <li class="navbar-nav-item">
        <a class="nav-link" href="<?= site_url('kegiatan') ?>">Kegiatan</a>
      </li>
      <!-- End Kegiatan -->

      <?php if ($this->session->userdata('logged_in') == false || !$this->session->userdata('logged_in')):?>
      <li class="list-inline-item d-none d-sm-block ml-2">
        <div class="hs-unfold">
          <a class="js-hs-unfold-invoker btn btn-xs btn-primary" href="javascript:;"
          data-hs-unfold-options='{
            "target": "#sidebarContent",
            "type": "css-animation",
            "animationIn": "fadeInRight",
            "animationOut": "fadeOutRight",
            "hasOverlay": "rgba(55, 125, 255, 0.1)",
            "smartPositionOff": true
          }'>
            Daftar
          </a>
        </div>
      </li>
      <li class="list-inline-item d-none d-sm-block ml-2">
        <div class="hs-unfold">
          <a class="js-hs-unfold-invoker btn btn-xs btn-outline-primary" href="javascript:;"
          data-hs-unfold-options='{
            "target": "#sidebarContentLogin",
            "type": "css-animation",
            "animationIn": "fadeInRight",
            "animationOut": "fadeOutRight",
            "hasOverlay": "rgba(55, 125, 255, 0.1)",
            "smartPositionOff": true
          }'>
            Masuk
          </a>
        </div>
      </li>
      <?php endif;?>
      <?php if ($this->session->userdata('logged_in') == false || !$this->session->userdata('logged_in')):?>
        <!-- Button -->
        <li class="navbar-nav-last-item d-block d-sm-none">
          <a class="btn btn-sm btn-primary btn-block transition-3d-hover" href="<?= site_url('login');?>">masuk ke akun</a>
        </li>
        <!-- End Button -->
      <?php endif;?>
    </ul>
  </div>
</div>