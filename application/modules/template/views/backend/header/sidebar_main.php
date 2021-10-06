<aside class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
  <div class="navbar-vertical-container">
    <div class="navbar-vertical-footer-offset">
      <div class="navbar-brand-wrapper justify-content-between">
        <!-- Logo -->
        <a class="navbar-brand" href="<?= base_url() ?>" aria-label="Front">
          <img class="navbar-brand-logo" src="<?= base_url(); ?>assets/<?= $LOGO_BLACK; ?>" alt="Logo">
          <img class="navbar-brand-logo-mini" src="<?= base_url(); ?>assets/<?= $LOGO_FAV; ?>" alt="Logo">
        </a>
        <!-- End Logo -->

        <!-- Navbar Vertical Toggle -->
        <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
          <i class="tio-clear tio-lg"></i>
        </button>
        <!-- End Navbar Vertical Toggle -->
      </div>

      <!-- Content -->
      <div class="navbar-vertical-content">
        <ul class="navbar-nav navbar-nav-lg nav-tabs">

          <!-- ADMIN UNIV -->
          <?php if ($this->session->userdata('role') == 3) : ?>
            <!-- Dashboards -->

            <li class="nav-item ">
              <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(1) == 'pts' ? 'active' : '') ?>" href="<?= site_url('pts') ?>" title="Dashboard" data-placement="left">
                <i class="tio-dashboard-vs-outlined nav-icon"></i>
                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Dashboard</span>
              </a>
            </li>

            <li class="nav-item ">
              <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(1) == 'transaksi-pts' ? 'active' : '') ?>" href="<?= site_url('transaksi-pts') ?>" title="Transaksi" data-placement="left">
                <i class="tio-receipt-outlined nav-icon"></i>
                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Transaksi</span>
              </a>
            </li>

            <li class="nav-item ">
              <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(1) == 'pengaturan-pts' ? 'active' : '') ?>" href="<?= site_url('pengaturan-pts') ?>" title="Pengaturan" data-placement="left">
                <i class="tio-settings-outlined nav-icon"></i>
                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Pengaturan</span>
              </a>
            </li>

            <!-- JURI -->
            <?php elseif ($this->session->userdata('role') == 2) : ?>
              <!-- Dashboards -->

              <li class="nav-item ">
                <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(1) == 'juri' && empty($this->uri->segment(2)) ? 'active' : '') ?>" href="<?= site_url('juri') ?>" title="Dashboard" data-placement="left">
                  <i class="tio-dashboard-vs-outlined nav-icon"></i>
                  <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Dashboard</span>
                </a>
              </li>

              <li class="nav-item ">
                <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(2) == 'penilaian' ? 'active' : '') ?>" href="<?= site_url('juri/penilaian') ?>" title="Penilaian" data-placement="left">
                  <i class="tio-files-outlined nav-icon"></i>
                  <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Penilaian</span>
                </a>
              </li>

              <li class="nav-item ">
                <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(2) == 'riwayat-penilaian' ? 'active' : '') ?>" href="<?= site_url('juri/riwayat-penilaian') ?>" title="Riwayat Penilaian" data-placement="left">
                  <i class="tio-receipt-outlined nav-icon"></i>
                  <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Riwayat Penilaian</span>
                </a>
              </li>

              <li class="nav-item ">
                <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(2) == 'hasil-penilaian' ? 'active' : '') ?>" href="<?= site_url('juri/hasil-penilaian') ?>" title="Hasil Penilaian" data-placement="left">
                  <i class="tio-medal nav-icon"></i>
                  <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Hasil Penilaian</span>
                </a>
              </li>
              <!-- End Dashboards -->
              <?php elseif ($this->session->userdata('role') == 0) : ?>
                <!-- Dashboards -->

                <li class="nav-item ">
                  <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(1) == 'admin' ? 'active' : '') ?>" href="<?= site_url('admin') ?>" title="Dashboard" data-placement="left">
                    <i class="tio-dashboard-vs-outlined nav-icon"></i>
                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Dashboard</span>
                  </a>
                </li>

                <!-- Pengguna -->
                <li class="navbar-vertical-aside-has-menu <?= ($this->uri->segment(1) == 'notifikasi-sistem' || $this->uri->segment(1) == 'aktivitas-sistem' ? 'show' : '') ?>">
                  <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle " href="javascript:;" title="Pages">
                    <i class="tio-browser-windows nav-icon"></i>
                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Sistem</span>
                  </a>

                  <ul class="js-navbar-vertical-aside-submenu nav nav-sub">

                    <li class="nav-item ">
                      <a class="nav-link <?= ($this->uri->segment(1) == 'notifikasi-sistem' ? 'active' : '') ?>" href="<?= site_url('notifikasi-sistem') ?>" title="Notifikasi">
                        <span class="tio-circle nav-indicator-icon"></span>
                        <span class="text-truncate">Notifikasi</span>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link <?= ($this->uri->segment(1) == 'aktivitas-sistem' ? 'active' : '') ?>" href="<?= site_url('aktivitas-sistem') ?>" title="Aktivitas">
                        <span class="tio-circle nav-indicator-icon"></span>
                        <span class="text-truncate">Aktivitas</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!-- End Pengguna -->

                <li class="nav-item ">
                  <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(1) == 'pengaturan-admin' ? 'active' : '') ?>" href="<?= site_url('pengaturan-admin') ?>" title="Pengaturan" data-placement="left">
                    <i class="tio-tune nav-icon"></i>
                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Pengaturan</span>
                  </a>
                </li>
                <!-- End Dashboards -->

                <li class="nav-item">
                  <small class="nav-subtitle" title="Pages">Data Pengguna</small>
                  <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                </li>

                <!-- Pengguna -->
                <li class="nav-item ">
                  <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(2) == 'data-juri' ? 'active' : '') ?>" href="<?= site_url('kompetisi/data-juri') ?>" title="Data Juri" data-placement="left">
                    <i class="tio-user nav-icon"></i>
                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Data Juri</span>
                  </a>
                </li>
                <!-- End Dashboards -->

                <!-- Pengguna -->
                <li class="nav-item ">
                  <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(1) == 'data-koordinator' ? 'active' : '') ?>" href="<?= site_url('data-koordinator') ?>" title="Data Koordinator" data-placement="left">
                    <i class="tio-user nav-icon"></i>
                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Data Koordinator</span>
                  </a>
                </li>
                <!-- End Dashboards -->

                <!-- Pengguna -->
                <li class="nav-item ">
                  <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(1) == 'data-kolektif-pts' ? 'active' : '') ?>" href="<?= site_url('data-kolektif-pts') ?>" title="Data Kolektif PTS" data-placement="left">
                    <i class="tio-user nav-icon"></i>
                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Data Kolektif PTS</span>
                  </a>
                </li>
                <!-- End Dashboards -->

                <li class="nav-item">
                  <small class="nav-subtitle" title="Pages">Pembayaran</small>
                  <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                </li>

                <li class="nav-item ">
                  <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(2) == 'data-transaksi' ? 'active' : '') ?>" href="<?= site_url('data-transaksi') ?>" title="Data Transaksi" data-placement="left">
                    <i class="tio-table nav-icon"></i>
                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Data Transaksi</span>
                  </a>
                </li>

                <li class="nav-item ">
                  <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(2) == 'data-refund' ? 'active' : '') ?>" href="<?= site_url('data-refund') ?>" title="Kelola Refund" data-placement="left">
                    <i class="tio-receipt-outlined nav-icon"></i>
                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Data Refund</span>
                  </a>
                </li>


                <li class="nav-item">
                  <small class="nav-subtitle" title="Pages">Data Master</small>
                  <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                </li>

                <!-- Pengguna -->
                <li class="nav-item">
                  <a class="nav-link <?= ($this->uri->segment(1) == 'pengajuan-pts' ? 'active' : '') ?>" href="<?= site_url('pengajuan-pts') ?>" title="Pengajuan PTS baru">
                    <span class="tio-briefcase nav-icon"></span>
                    <span class="text-truncate">Pengajuan PTS Baru</span>
                  </a>
                </li>
                <!-- End Pengguna -->

                <li class="nav-item ">
                  <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(1) == 'berkas-lomba' ? 'active' : '') ?>" href="<?= site_url('berkas-lomba') ?>" title="Berkas Lomba" data-placement="left">
                    <i class="tio-albums nav-icon"></i>
                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Berkas lomba</span>
                  </a>
                </li>
                <!-- End Dashboards -->

                <li class="nav-item ">
                  <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(2) == 'bidang-lomba' ? 'active' : '') ?>" href="<?= site_url('kompetisi/bidang-lomba') ?>" title="Bidang Lomba" data-placement="left">
                    <i class="tio-albums nav-icon"></i>
                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Bidang Lomba</span>
                  </a>
                </li>
                <!-- End Dashboards -->

                <li class="nav-item ">
                  <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(2) == 'tahap-penilaian' ? 'active' : '') ?>" href="<?= site_url('kompetisi/tahap-penilaian') ?>" title="Tahap Penilaian" data-placement="left">
                    <i class="tio-blend-tool nav-icon"></i>
                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Tahap Penilaian</span>
                  </a>
                </li>
                <!-- End Dashboards -->

                <li class="nav-item ">
                  <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(2) == 'kriteria-penilaian' ? 'active' : '') ?>" href="<?= site_url('kompetisi/kriteria-penilaian') ?>" title="Kriteria Penilaian" data-placement="left">
                    <i class="tio-category-outlined nav-icon"></i>
                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Kriteria Penilaian</span>
                  </a>
                </li>

                <li class="nav-item ">
                  <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(2) == 'atur-pendaftaran' ? 'active' : '') ?>" href="<?= site_url('kompetisi/atur-pendaftaran') ?>" title="Atur Berkas Pendaftaran" data-placement="left">
                    <i class="tio-artboard-outlined nav-icon"></i>
                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Atur Berkas Pendaftaran</span>
                  </a>
                </li>
                <!-- End Dashboards -->

                <li class="nav-item">
                  <small class="nav-subtitle" title="Pages">Lomba</small>
                  <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                </li>

                <!-- Pengguna -->
                <li class="nav-item">
                  <a class="nav-link <?= ($this->uri->segment(1) == 'data-peserta' ? 'active' : '') ?>" href="<?= site_url('data-peserta') ?>" title="Data Peserta">
                    <span class="tio-group-junior nav-icon"></span>
                    <span class="text-truncate">Data Peserta</span>
                  </a>
                </li>
                <!-- End Pengguna -->

                <li class="nav-item ">
                  <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(2) == 'verifikasi-berkas' ? 'active' : '') ?>" href="<?= site_url('koordinator/verifikasi-berkas') ?>" title="Verifikasi Berkas" data-placement="left">
                    <i class="tio-files nav-icon"></i>
                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Verifikasi Berkas</span>
                  </a>
                </li>
                <!-- End Dashboards -->

                <li class="nav-item ">
                  <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(2) == 'seleksi' ? 'active' : '') ?>" href="<?= site_url('admin/seleksi') ?>" title="Verifikasi Berkas" data-placement="left">
                    <i class="tio-files nav-icon"></i>
                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Seleksi</span>
                  </a>
                </li>
                <!-- End Dashboards -->

                <li class="nav-item ">
                  <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(2) == 'hasil-penilaian' ? 'active' : '') ?>" href="<?= site_url('kompetisi/hasil-penilaian') ?>" title="Hasil Penilaian" data-placement="left">
                    <i class="tio-medal nav-icon"></i>
                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Hasil Penilaian</span>
                  </a>
                </li>
                <!-- End Dashboards -->

                <li class="nav-item">
                  <small class="nav-subtitle" title="Pages">Kegiatan</small>
                  <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                </li>

                <!-- Pengguna -->
                <li class="navbar-vertical-aside-has-menu <?= ($this->uri->segment(2) == 'kegiatanku' || $this->uri->segment(2) == 'buat-kegiatan' ? 'show' : '') ?>">
                  <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle " href="javascript:;" title="Pages">
                    <i class="tio-browser-windows nav-icon"></i>
                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Kegiatan</span>
                  </a>

                  <ul class="js-navbar-vertical-aside-submenu nav nav-sub">

                    <li class="nav-item ">
                      <a class="nav-link <?= ($this->uri->segment(2) == 'kegiatanku' ? 'active' : '') ?>" href="<?= site_url('kegiatanku') ?>" title="Kegiatanku">
                        <span class="tio-circle nav-indicator-icon"></span>
                        <span class="text-truncate">Kegiatanku</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link <?= ($this->uri->segment(2) == 'buat-kegiatan' ? 'active' : '') ?>" href="<?= site_url('buat-kegiatan') ?>" title="Buat Kegiatan">
                        <span class="tio-circle nav-indicator-icon"></span>
                        <span class="text-truncate">Buat kegiatan</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!-- End Pengguna -->
                <!-- End Pengguna -->
                <?php elseif ($this->session->userdata('role') == 4) : ?>
                  <li class="nav-item">
                    <small class="nav-subtitle" title="Pages">Koordinator</small>
                    <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                  </li>

                  <!-- Pengguna -->
                  <li class="nav-item">
                    <a class="nav-link <?= ($this->uri->segment(1) == 'data-peserta' ? 'active' : '') ?>" href="<?= site_url('data-peserta') ?>" title="Data Peserta">
                      <span class="tio-group-junior nav-icon"></span>
                      <span class="text-truncate">Data Peserta</span>
                    </a>
                  </li>
                  <!-- End Pengguna -->

                  <!-- Pengguna -->
                  <li class="nav-item">
                    <a class="nav-link <?= ($this->uri->segment(2) == 'verifikasi-berkas' ? 'active' : '') ?>" href="<?= site_url('koordinator/verifikasi-berkas') ?>" title="Data Peserta">
                      <i class="tio-files nav-icon"></i>
                      <span class="text-truncate"> Verifikai Berkas</span>
                    </a>
                  </li>
                  <!-- End Pengguna -->

                  <li class="nav-item ">
                    <a class="js-nav-tooltip-link nav-link <?= ($this->uri->segment(2) == 'hasil-penilaian' ? 'active' : '') ?>" href="<?= site_url('koordinator/hasil-penilaian') ?>" title="Hasil Penilaian" data-placement="left">
                      <i class="tio-medal nav-icon"></i>
                      <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Hasil Penilaian</span>
                    </a>
                  </li>
                <?php endif; ?>
                <li class="nav-item">
                  <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- End Content -->

        <!-- Footer -->
        <div class="navbar-vertical-footer">
          <ul class="navbar-vertical-footer-list">

            <li class="navbar-vertical-footer-list-item">
            </li>
          </ul>
        </div>
        <!-- End Footer -->
      </div>
    </div>
  </aside>