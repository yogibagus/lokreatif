<!-- Page Header -->
<div class="page-header">
  <div class="row align-items-end mb-3">
    <div class="col-sm">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-no-gutter">
          <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?= site_url('admin') ?>">Dashboard</a></li>
          <li class="breadcrumb-item" aria-current="page"><a class="breadcrumb-link" href="<?= site_url('pengaturan-admin') ?>">Pengaturan</a></li>
          <li class="breadcrumb-item active" aria-current="page">Website</li>
        </ol>
      </nav>

      <h1 class="page-header-title">Pengaturan website</h1>
    </div>
  </div>
  <!-- End Row -->
</div>
<!-- End Page Header -->

<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h5 class="card-header-title">Website</h5>
      </div>
      <div class="card-body">
        <button type="button" class="btn btn-soft-primary btn-pill mr-1" data-toggle="modal" data-target="#ubah_logoFav"><i class="tio-image"></i> favicon</button>
        <button type="button" class="btn btn-soft-primary btn-pill mr-1" data-toggle="modal" data-target="#ubah_logoBlack"><i class="tio-photo-square"></i> logo default</button>
        <button type="button" class="btn btn-soft-primary btn-pill" data-toggle="modal" data-target="#ubah_logoWhite"><i class="tio-photo-square-outlined"></i> logo inverse</button>
        <hr>
        <form action="<?= site_url('admin/ubah_websiteInfo') ?>" method="post">
          <div class="form-group">
            <label class="input-label">Judul</label>
            <input type="text" name="WEB_JUDUL" class="form-control" value="<?= $WEB_JUDUL;?>" required>
          </div>
          <div class="form-group">
            <label class="input-label">Deskripsi</label>
            <textarea type="text" name="WEB_DESKRIPSI" class="form-control" rows="3" required><?= $WEB_DESKRIPSI;?></textarea>
          </div>
          <div class="form-group">
            <label class="input-label">Contact (WA)</label>
            <!-- Input Group -->
            <div class="input-group input-group-merge">
              <div class="input-group-prepend">
                <span class="input-group-text p-2">
                  +62
                </span>
              </div>
              <input type="text" name="WEB_WA" class="form-control" minlength="10" value="<?= $WEB_WA;?>" required>
            </div>
            <!-- End Input Group -->
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label class="input-label">Hero button</label>
                <!-- Checkbox Switch -->
                <label class="toggle-switch d-flex align-items-center mb-3" for="<?= $WEB_HERO_BUTTON;?>">
                  <input type="checkbox" class="toggle-switch-input" name="WEB_HERO_BUTTON" id="<?= $WEB_HERO_BUTTON;?>" <?= ($WEB_HERO_BUTTON == 1) ? "checked" : "";?>>
                  <span class="toggle-switch-label">
                    <span class="toggle-switch-indicator"></span>
                  </span>
                  <span class="toggle-switch-content">
                    <span class="d-block">Tampilkan hero button di halaman utama?</span>
                  </span>
                </label>
                <!-- End Checkbox Switch -->
              </div>
            </div>
          </div>
          <hr><br>
          <button type="submit" class="btn btn-sm btn-primary float-right">Simpan perubahan</button>
        </form>
      </div>
    </div>

  </div>

  <div class="col-md-4">

    <!-- Card -->
    <div class="card mb-3">
      <!-- Header -->
      <div class="card-header">
        <h5 class="card-header-title">Social Media</h5>
        <button type="button" data-toggle="modal" data-target="#ubahSosmed" class="btn btn-xs btn-primary pull-right">manage</button>
      </div>
      <!-- End Header -->

      <!-- Body -->
      <div class="card-body">
        <ul class="list-unstyled list-unstyled-py-3 text-dark mb-3">
          <li class="py-0">
            <small class="card-subtitle">Link sosmed</small>
          </li>

          <li>
            <i class="tio-instagram nav-icon mr-1"></i>
            <a href="<?= $LN_INSTAGRAM;?>" class="text-muted" target="_blank"><?= $LN_INSTAGRAM;?></a>
          </li>
          <li>
            <i class="tio-facebook nav-icon mr-1"></i>
            <a href="<?= $LN_FACEBOOK;?>" class="text-muted" target="_blank"><?= $LN_FACEBOOK;?></a>
          </li>
          <li>
            <i class="tio-twitter nav-icon mr-1"></i>
            <a href="<?= $LN_TWITTER;?>" class="text-muted" target="_blank"><?= $LN_TWITTER;?></a>
          </li>
          <li>
            <i class="tio-github nav-icon mr-1"></i>
            <a href="<?= $LN_GITHUB;?>" class="text-muted" target="_blank"><?= $LN_GITHUB;?></a>
          </li>
        </ul>
      </div>
      <!-- End Body -->
    </div>
    <!-- End Card -->

  </div>
</div>

<!-- ubah password Modal -->
<div class="modal fade bd-example-modal-sm" id="ubahSosmed" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4" id="mySmallModalLabel">Manage Sosmed link</h5>
        <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary" data-dismiss="modal" aria-label="Close">
          <i class="tio-clear tio-lg"></i>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('admin/ubah_sosmed') ?>" method="POST">
          <div class="form-group mb-0">
            <label class="input-label"><i class="tio-instagram nav-icon mr-1"></i> Facebook</label>
            <input type="text" class="form-control form-control-sm" name="LN_FACEBOOK" value="<?= $LN_FACEBOOK;?>" required>
          </div>
          <hr>
          <div class="form-group">
            <label class="input-label"><i class="tio-facebook nav-icon mr-1"></i> Instagram</label>
            <input type="text" class="form-control form-control-sm" name="LN_INSTAGRAM" value="<?= $LN_INSTAGRAM;?>" required>
          </div>
          <div class="form-group">
            <label class="input-label"><i class="tio-twitter nav-icon mr-1"></i> Twitter</label>
            <input type="text" class="form-control form-control-sm" name="LN_TWITTER" value="<?= $LN_TWITTER;?>" required>
          </div>
          <div class="form-group">
            <label class="input-label"><i class="tio-github nav-icon mr-1"></i> Github</label>
            <input type="text" class="form-control form-control-sm" name="LN_GITHUB" value="<?= $LN_GITHUB;?>" required>
          </div>
          <hr>
          <button type="submit" class="btn btn-sm btn-success float-right">Ubah</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End ubah password Modal -->



<!-- CHANGE LOGO PROFIL -->

<div id="ubah_logoFav" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ubah_logoFav" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <form action="<?= site_url('admin/ubah_logoFav') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body pb-0">
          <!-- Form Group -->
          <div class="form-group mx-auto mb-2">
            <h5 for="fotoLabel" class="input-label">Logo Favicon</h5>
            <label for="GETL_LOGO_FAV" class="upload-card mx-auto">
              <img id="L_LOGO_FAV" class="upload-img w-100 L_LOGO_FAV cursor" src="<?= ($LOGO_FAV == null ? base_url().'assets/frontend/img/others/Pickanimage.png' : base_url().'assets/'.$LOGO_FAV);?>" alt="<?= $LOGO_FAV;?>">
            </label>
            <input type="file" id="GETL_LOGO_FAV" class="form-control-file hidden" name="LOGO_FAV"  onchange="previewL_LOGO_FAV(this);" accept="image/*">
            <small class="text-muted">Max 2Mb size, and use 1:1 ratio.</small>
          </div>
          <!-- End Form Group -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-white" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-sm btn-primary">Ubah foto</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">

  function previewL_LOGO_FAV(input){
    $(".L_LOGO_FAV").removeClass('hidden');
    var file = $("#GETL_LOGO_FAV").get(0).files[0];

    if(file){
      var reader = new FileReader();

      reader.onload = function(){
        $("#L_LOGO_FAV").attr("src", reader.result);
      }

      reader.readAsDataURL(file);
    }
  }
</script>

<!-- CHANGE LOGO PROFIL -->

<div id="ubah_logoWhite" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ubah_logoWhite" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <form action="<?= site_url('admin/ubah_logoWhite') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body pb-0 px-0">
          <!-- Form Group -->
          <h5 for="fotoLabel" class="input-label px-4">Logo inverse</h5>
          <div class="form-group mx-auto mb-2 bg-secondary">
            <label for="GETL_LOGO_WHITE" class="upload-card mx-auto">
              <img id="L_LOGO_WHITE" class="w-100 L_LOGO_WHITE cursor" src="<?= ($LOGO_WHITE == null ? base_url().'<?= base_url();?>assets/frontend/img/others/Pickanimage.png' : base_url().'assets/'.$LOGO_WHITE);?>" alt="<?= $LOGO_WHITE;?>">
            </label>
            <input type="file" id="GETL_LOGO_WHITE" class="form-control-file hidden" name="LOGO_WHITE"  onchange="previewL_LOGO_WHITE(this);" accept="image/*">
          </div>
          <small class="text-muted px-4">Max 2Mb size, and use 1:3 ratio.</small>
          <!-- End Form Group -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-white" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-sm btn-primary">Ubah foto</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">

  function previewL_LOGO_WHITE(input){
    $(".L_LOGO_WHITE").removeClass('hidden');
    var file = $("#GETL_LOGO_WHITE").get(0).files[0];

    if(file){
      var reader = new FileReader();

      reader.onload = function(){
        $("#L_LOGO_WHITE").attr("src", reader.result);
      }

      reader.readAsDataURL(file);
    }
  }
</script>

<!-- CHANGE LOGO PROFIL -->

<div id="ubah_logoBlack" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ubah_logoBlack" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <form action="<?= site_url('admin/ubah_logoBlack') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body pb-0">
          <!-- Form Group -->
          <div class="form-group mx-auto mb-2">
            <h5 for="fotoLabel" class="input-label">Logo default</h5>
            <label for="GETL_LOGO_BLACK" class="upload-card mx-auto">
              <img id="L_LOGO_BLACK" class="w-100 L_LOGO_BLACK cursor" src="<?= ($LOGO_BLACK == null ? base_url().'<?= base_url();?>assets/frontend/img/others/Pickanimage.png' : base_url().'assets/'.$LOGO_BLACK);?>" alt="<?= $LOGO_BLACK;?>">
            </label>
            <input type="file" id="GETL_LOGO_BLACK" class="form-control-file hidden" name="LOGO_BLACK"  onchange="previewL_LOGO_BLACK(this);" accept="image/*">
            <small class="text-muted">Max 2Mb size, and use 1:1 ratio.</small>
          </div>
          <!-- End Form Group -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-white" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-sm btn-primary">Ubah foto</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">

  function previewL_LOGO_BLACK(input){
    $(".L_LOGO_BLACK").removeClass('hidden');
    var file = $("#GETL_LOGO_BLACK").get(0).files[0];

    if(file){
      var reader = new FileReader();

      reader.onload = function(){
        $("#L_LOGO_BLACK").attr("src", reader.result);
      }

      reader.readAsDataURL(file);
    }
  }
</script>