    <!-- Hero Section -->
    <div class="position-relative space-bottom-3">
      <div class="bg-img-hero" style="background-image: url(<?= base_url();?>assets/frontend/svg/components/abstract-shapes-12.svg);">
        <div class="container space-top-2 space-bottom-2 position-relative z-index-2">
          <div class="w-md-80 w-lg-60 text-center mx-md-auto mb-5 mb-md-9">
            <h1>Hubungi kami</h1>
            <p>Perlu bantuan? anda dapat menghubungi kami, atau membuka pusat bantuan</p>
          </div>

          <div class="row">
            <div class="col-md-4 mb-3 mb-md-0 mb-md-n11">
              <!-- Card -->
              <a class="card text-center h-100 transition-3d-hover" href="mailto:<?= $WEB_EMAIL;?>">
                <div class="card-body p-lg-5">
                  <figure class="max-w-8rem w-100 mx-auto mb-4">
                    <img class="img-fluid" src="<?= base_url();?>assets/frontend/svg/icons/icon-15.svg" alt="SVG">
                  </figure>
                  <h3 class="h4">Email</h3>
                  <p class="text-body mb-0">Kirimi kami email.</p>
                </div>
                <div class="card-footer font-weight-bold py-3 px-lg-5">
                  <i class="fas fa-envelope-open-text fa-sm ml-1"></i> <?= $WEB_EMAIL;?>
                </div>
              </a>
              <!-- End Card -->
            </div>

            <div class="col-md-4 mb-3 mb-md-0 mb-md-n11">
              <!-- Card -->
              <a class="card text-center h-100 transition-3d-hover" href="https://api.whatsapp.com/send?text=Hai&phone=<?= $WEB_WA;?>">
                <div class="card-body p-lg-5">
                  <figure class="max-w-8rem w-100 mx-auto mb-4">
                    <img class="img-fluid" src="<?= base_url();?>assets/frontend/svg/icons/icon-4.svg" alt="SVG">
                  </figure>
                  <h3 class="h4">Telepon & Whatsapp</h3>
                  <p class="text-body mb-0">Hubungi kami melalui telpon / Whatsapp.</p>
                </div>
                <div class="card-footer font-weight-bold py-3 px-lg-5">
                  <i class="fab fa-whatsapp fa-sm ml-1"></i> +62<?= $WEB_WA;?>
                </div>
              </a>
              <!-- End Card -->
            </div>

            <div class="col-md-4 mb-md-n11">
              <!-- Card -->
              <a class="card text-center h-100 transition-3d-hover" href="<?= site_url('pusat-bantuan');?>">
                <div class="card-body p-lg-5">
                  <figure class="max-w-8rem w-100 mx-auto mb-4">
                    <img class="img-fluid" src="<?= base_url();?>assets/frontend/svg/icons/icon-12.svg" alt="SVG">
                  </figure>
                  <h3 class="h4">Pusat Bantuan</h3>
                  <p class="text-body mb-0">Telusuri pusat bantuan kami.</p>
                </div>
                <div class="card-footer font-weight-bold py-3 px-lg-5">
                  <i class="fas fa-question fa-sm ml-1"></i> kunjungi
                </div>
              </a>
              <!-- End Card -->
            </div>
          </div>
        </div>
      </div>

      <!-- SVG Shape -->
      <figure class="position-absolute bottom-0 right-0 left-0">
        <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1921 273">
          <polygon fill="#fff" points="0,273 1921,273 1921,0 "/>
        </svg>
      </figure>
      <!-- End SVG Shape -->
    </div>
    <!-- End Hero Section -->
