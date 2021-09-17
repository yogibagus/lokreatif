<!-- Login Form -->
<div class="container space-2 space-lg-3">
  <form class="js-validate w-md-75 w-lg-50 mx-md-auto" action="<?= site_url('authentication/daftar_peserta') ?>" method="post">
    <!-- Title -->
    <div class="mb-5 mb-md-7">
      <h1 class="h2 mb-0">Daftar sekarang!</h1>
    </div>
    <!-- End Title -->

    <!-- Form Group -->
    <div class="js-form-message form-group">
      <label class="input-label" for="signinSrNama">Nama lengkap  <span class="text-danger">*</span></label>
      <input type="text" class="form-control" name="nama" id="signinSrNama" pattern="[A-Za-z]" placeholder="Nama lengkap " aria-label="Nama lengkap " required data-msg="Harap masukkan nama lengkap .">
    </div>
    <!-- End Form Group -->

    <!-- Form Group -->
    <div class="js-form-message form-group">
      <label for="listingBathrooms" class="input-label">Jenis Kelamin <span class="text-danger">*</span></label>
      <div class="input-group input-group-up-break">
        <!-- Custom Radio -->
        <div class="form-control">
          <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" name="jk" id="jk1" value="L" checked>
            <label class="custom-control-label" for="jk1">Laki-laki</label>
          </div>
        </div>
        <!-- End Custom Radio -->

        <!-- Custom Radio -->
        <div class="form-control">
          <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" name="jk" id="jk2" value="P">
            <label class="custom-control-label" for="jk2">Perempuan</label>
          </div>
        </div>
        <!-- End Custom Radio -->
      </div>
    </div>

    <!-- Form Group -->
    <div class="js-form-message form-group">
      <label class="input-label" for="signinSrEmail">Email  <span class="text-danger">*</span></label>
      <input type="email" class="form-control" name="email" id="signinSrEmail" <?= ($email == null ? 'placeholder="Email "' : 'value="'.$email.'"');?> aria-label="Email " required data-msg="Harap masukkan email .">
    </div>
    <!-- End Form Group -->

    <!-- Form Group -->
    <div class="js-form-message form-group">
      <label class="input-label" for="signinSrTelepon">Nomor telepon  <span class="text-danger">*</span></label>
      <!-- Input Group -->
      <div class="input-group input-group-merge">
        <div class="input-group-prepend">
          <span class="input-group-text p-2">
            +62
          </span>
        </div>
        <input type="tel" class="form-control" name="hp" id="signinSrTelepon" placeholder="Nomor telepon" aria-label="Nomor telepon " required data-msg="Harap masukkan nomor telepon .">
      </div>
      <!-- End Input Group -->
      <small class="text-muted">Ex: 81987123465</small>
    </div>
    <!-- End Form Group -->

    <!-- Form Group -->
    <div class="js-form-message form-group">
      <label class="input-label" for="signinSrPassword">Password <span class="text-danger">*</span></label>
      <input type="password" class="form-control" name="password" minlength="6" id="signinSrPassword" placeholder="********" aria-label="********" required required data-msg="Harap masukkan password, minimal 6 karakter.">
    </div>
    <!-- End Form Group -->

    <!-- Form Group -->
    <div class="js-form-message form-group">
      <label class="input-label" for="signinSrConfirmPassword">Konfirmasi password</label>
      <input type="password" class="form-control" name="confirmPassword" minlength="6" id="signinSrConfirmPassword" placeholder="********" aria-label="********" required required data-msg="Harap masukkan konfirmasi password, minimal 6 karakter">
    </div>
    <!-- End Form Group -->

    <!-- Checkbox -->
    <div class="js-form-message mb-5">
      <div class="custom-control custom-checkbox d-flex align-items-center text-muted">
        <input type="checkbox" class="custom-control-input" id="termsCheckbox" name="termsCheckbox" required
        data-msg="Harap setuju dengan syarat dan kondisi kami.">
        <label class="custom-control-label" for="termsCheckbox">
          <small>
            Saya setuju dengan
            <a class="link-underline" data-toggle="modal" data-target="#syaratdanketentuan">Syarat dan kondisi</a>
          </small>
        </label>
      </div>
    </div>
    <!-- End Checkbox -->

    <!-- Button -->
    <div class="row align-items-center mb-5">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <span class="font-size-1 text-muted">Sudah punya akun?</span>
        <a class="font-size-1 font-weight-bold" href="<?= site_url('login') ?>">Login</a>
      </div>

      <div class="col-sm-6 text-sm-right">
        <button type="submit" id="send-button" class="btn btn-primary btn-sm transition-3d-hover">Daftar Sekarang</button>
      </div>
    </div>
    <!-- End Button -->
  </form>
</div>
<!-- End Login Form -->

<script type="text/javascript">
  $(document).ready(function(){
    $("#signinSrNama").keydown(function(event){
      var inputValue = event.which;
        // allow letters and whitespaces only.
        if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0 && inputValue != 8 && inputValue != 37 && inputValue != 39)) { 
          event.preventDefault(); 
        }
      });
  });
  
  $("#signinSrTelepon").keyup(function(){
    var value = $(this).val();
    value = value.replace(/^(0*)/,"");
    $(this).val(value);
  });

  // Restricts input for the given textbox to the given inputFilter.
  function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
      textbox.addEventListener(event, function() {
        if (inputFilter(this.value)) {
          this.oldValue = this.value;
          this.oldSelectionStart = this.selectionStart;
          this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
          this.value = this.oldValue;
          this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        } else {
          this.value = "";
        }
      });
    });
  }

  // Install input filters Tambah Hp Pegawai.
  setInputFilter(document.getElementById("signinSrTelepon"), function(value) { return /^\d*$/.test(value); });
</script>



<div class="modal fade" id="syaratdanketentuan" role="dialog" tabindex="-1" role="dialog" aria-labelledby="syaratdanketentuan" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close alcs" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h2><strong>Syarat dan Kondisi</strong></h2>

        <p><?= $TERM_CONDITION;?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Mengerti</button>
      </div>
    </div>
  </div>
</div>