<!-- Login Form -->
<div class="container space-2 space-lg-3">
  <form class="js-validate w-md-75 w-lg-50 mx-md-auto" action="<?= site_url('authentication/proses_tambah_univ') ?>" method="post">
    <!-- Title -->
    <div class="mb-5 mb-md-7">
      <h1 class="h2 mb-0">Tambah PTS!</h1>
      <p>Daftarkan PTS anda yang belum tersedia.</p>
    </div>
    <!-- End Title -->


    <!-- Form Group -->
    <div class="js-form-message form-group">
      <label class="input-label" for="signinSrKode">Kode PTS <span class="text-danger">*</span></label>
      <input type="text" class="form-control" name="kodept" placeholder="Masukkan Kode PTS" required data-msg="Harap masukan kode PTS.">
      <small>Harap konfirmasi kode PTS ke lembaga anda</small>
    </div>
    <!-- End Form Group -->

    <!-- Form Group -->
    <div class="js-form-message form-group">
      <label class="input-label" for="signinSrNama">Nama PTS<span class="text-danger">*</span></label>
      <input type="text" class="form-control" name="namapt" aria-label="Nama PTS" placeholder="Masukkan Nama PTS" required data-msg="Harap masukkan nama PTS.">
    </div>
    <!-- End Form Group -->
    
    <!-- Form Group -->
    <div class="js-form-message form-group">
      <label class="input-label" for="signinSrJenis">Jenis PTS<span class="text-danger">*</span></label>
      <div class="tom-select-custom">

            <select class="js-custom-select custom-select" name="jenis" size="1"
            data-hs-select2-options='{
            "placeholder": "Pilih Jenis PTS"
          }' required data-msg="Harap masukkan jenis PTS.">
          <option value="">Pilih pts</option>
          <option>Universitas</option>
          <option>Institut</option>
          <option>Sekolah Tinggi</option>
          <option>Politeknik</option>
          <option>Akademi</option>
        </select>
      </div>
    </div>
    <!-- End Form Group -->
    <!-- Form Group -->
    <div class="js-form-message form-group">
      <label class="input-label" for="signinSrProv">Provinsi PTS<span class="text-danger">*</span></label>
      <div class="tom-select-custom">

            <select class="js-custom-select custom-select" name="prov" size="1"
            data-hs-select2-options='{
            "placeholder": "Pilih Provinsi PTS"
          }' required data-msg="Harap masukkan provinsi PTS.">
          <option value="">Pilih pts</option>
          <?php
            foreach ($provinsi as $item) {
              echo '
                <option value="'.$item->NAMA_PROVINSI.'">'.$item->NAMA_PROVINSI.'</option>
              ';
            }
          ?>
        </select>
      </div>
    </div>
    <!-- End Form Group -->

    <!-- Button -->
    <div class="row align-items-center mb-5">

      <div class="col-sm-6 text-sm-right">
        <button type="submit" class="btn btn-primary btn-sm transition-3d-hover">Request PTS</button>
      </div>
    </div>
    <!-- End Button -->
  </form>
</div>
<!-- End Login Form -->

<script type="text/javascript">

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

  // Install input filters Tambah Hp Pegawai.
  setInputFilter(document.getElementById("signinSrTelepon"), function(value) { return /^\d*$/.test(value); });
</script>
