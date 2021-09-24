<!-- Login Form -->
<div class="container space-2 space-lg-3">
  <form class="js-validate w-md-75 w-lg-50 mx-md-auto" action="<?= site_url('authentication/proses_daftar_univ') ?>" method="post">
    <!-- Title -->
    <div class="mb-5 mb-md-7">
      <h1 class="h2 mb-0">Daftar sekarang!</h1>
      <p>Daftarkan PTS anda untuk dapat mengelolah tim dari PTS anda.</p>
    </div>
    <!-- End Title -->

    <!-- Form Group -->
    <div class="form-group">
      <label class="input-label" for="signinSrNama">Nama PTS <span class="text-danger">*</span></label>
      <select name="kodept" id="select-pts" class="custom-select" data-select="listPts" size="1" style="width: 100%;"
              data-hs-select2-options='{
                "placeholder": "Pilih PTS"
              }'>
      </select>
      <small>
        <span class="font-size-1 text-muted">PTS anda tidak tersedia?</span>
        <a class="font-size-1 font-weight-bold" href="<?= site_url('tambah-pts') ?>">Daftarkan PTS</a>
      </small>
    </div>
    <!-- End Form Group -->

    <!-- Form Group -->
    <div class="form-group">
      <label class="input-label" for="signinSrEmail">Email <span class="text-danger">*</span></label>
      <input type="email" class="form-control" name="email" id="signinSrEmail" <?= ($email == null ? 'placeholder="Email anda"' : 'value="'.$email.'"');?> aria-label="Email anda" required data-msg="Harap masukkan email anda.">
    </div>
    <!-- End Form Group -->

    <!-- Form Group -->
    <div class="form-group">
      <label class="input-label" for="signinSrTelepon">Nomor telepon <span class="text-danger">*</span></label>
      <!-- Input Group -->
      <div class="input-group input-group-merge">
        <div class="input-group-prepend">
          <span class="input-group-text p-2">
            +62
          </span>
        </div>
        <input type="tel" class="form-control" name="hp" id="signinSrTelepon" placeholder="Nomor telepon anda" aria-label="Nomor telepon anda" required data-msg="Harap masukkan nomor telepon anda.">
      </div>
      <!-- End Input Group -->
      <small class="text-muted">Ex: 81987123465</small>
    </div>
    <!-- End Form Group -->

    <!-- Form Group -->
    <div class="form-group">
      <label class="input-label" for="signinSrPassword">Password <span class="text-danger">*</span></label>
      <input type="password" class="form-control" name="password" minlength="6" id="signinSrPassword" placeholder="********" aria-label="********" required required data-msg="Harap masukkan password, minimal 6 karakter.">
    </div>
    <!-- End Form Group -->

    <!-- Form Group -->
    <div class="form-group">
      <label class="input-label" for="signinSrConfirmPassword">Konfirmasi password</label>
      <input type="password" class="form-control" name="confirmPassword" minlength="6" id="signinSrConfirmPassword" placeholder="********" aria-label="********" required required data-msg="Harap masukkan konfirmasi password, minimal 6 karakter">
    </div>
    <!-- End Form Group -->

    <!-- Checkbox -->
    <div class="mb-5">
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
        <button type="submit" class="btn btn-primary btn-sm transition-3d-hover">Daftar Sekarang</button>
      </div>
    </div>
    <!-- End Button -->
  </form>
</div>
<!-- End Login Form -->

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

<script type="text/javascript">
  $('#select-pts').select2({
    ajax: {
      url: '<?= site_url('ajx-data-pts')?>',
      dataType: 'json',
      method: 'post',
      data: params => {
        console.log(params)
        var query = {
          search: params.term,
          type: 'public'
        }
        return query;
      },
      processResults: data => {
        let arrData = [];
        for(x of data){
          temp = {id: x.kodept, text: x.namapt}
          arrData.push(temp)
        }
        return {results: arrData}
      }
    },
    placeholder: "Pilih PTS",
    selectionCssClass: 'custom-select'
  });

  $('input:radio[name="jabatan"]').change(
    function(){
      if (this.checked && this.value == '3') {
        $("#lainnya").removeClass('hidden');
        console.log("check");
      }else {
        $("#lainnya").addClass('hidden');
        console.log("uncheck");
      }
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

  const get_ajaxDataPTS = () => {
    
  }

  

  // Install input filters Tambah Hp Pegawai.
  setInputFilter(document.getElementById("signinSrTelepon"), function(value) { return /^\d*$/.test(value); });
</script>
